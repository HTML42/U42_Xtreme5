<?php

$sourceDirectory = __DIR__ . '/latest';
$outputFile = __DIR__ . '/latest-dump.md';

if (!is_dir($sourceDirectory)) {
    fwrite(STDERR, "Source directory 'latest' was not found.\n");
    exit(1);
}

$files = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(
        $sourceDirectory,
        FilesystemIterator::SKIP_DOTS | FilesystemIterator::FOLLOW_SYMLINKS
    )
);

foreach ($iterator as $fileInfo) {
    if ($fileInfo->isFile() && shouldDumpFile($fileInfo)) {
        $files[] = $fileInfo->getPathname();
    }
}

sort($files, SORT_STRING);

$handle = fopen($outputFile, 'w');

if ($handle === false) {
    fwrite(STDERR, "Konnte Ausgabedatei nicht öffnen: {$outputFile}\n");
    exit(1);
}

$headerLines = [
    '# Latest framework dump',
    'Erzeugt am ' . date(DATE_ATOM),
    '',
];

writeLines($handle, $headerLines);

foreach ($files as $filePath) {
    $relativePath = 'latest/' . ltrim(str_replace($sourceDirectory, '', $filePath), DIRECTORY_SEPARATOR);
    $content = file_get_contents($filePath);

    $section = ["## {$relativePath}"];

    if ($content === false) {
        $section[] = '';
        $section[] = '_Datei konnte nicht gelesen werden._';
        $section[] = '';
        writeLines($handle, $section);
        continue;
    }

    $normalizedContent = str_replace(["\r\n", "\r"], "\n", $content);
    unset($content);

    $description = buildDescription($relativePath, $normalizedContent);
    $language = languageHint($filePath);

    if ($description !== '') {
        $section[] = "- Kurzbeschreibung: {$description}";
        $section[] = '';
    }

    $section[] = "```{$language}";
    writeLines($handle, $section);

    fwrite($handle, $normalizedContent . "\n");

    $sectionEnd = ['```', ''];
    writeLines($handle, $sectionEnd);
    unset($normalizedContent);
}

fclose($handle);

echo "Dump erstellt: {$outputFile}\n";

$targetDump = __DIR__ . '/emptypage/framework-dump.md';

if (!is_dir(dirname($targetDump))) {
    fwrite(STDERR, "Zielverzeichnis für Dump existiert nicht: " . dirname($targetDump) . "\n");
    exit(1);
}

if (!copy($outputFile, $targetDump)) {
    fwrite(STDERR, "Konnte Dump nicht nach {$targetDump} kopieren.\n");
    exit(1);
}

echo "Dump kopiert nach {$targetDump}\n";

function buildDescription(string $relativePath, string $content): string
{
    $basename = basename($relativePath);
    $extension = strtolower(pathinfo($basename, PATHINFO_EXTENSION));

    $firstLine = firstMeaningfulLine($content);
    if ($firstLine !== '') {
        return $firstLine;
    }

    switch ($extension) {
        case 'php':
            return 'PHP-Quelldatei des Frameworks.';
        case 'js':
            return 'JavaScript-Datei für Frontend-Logik oder Assets.';
        case 'css':
            return 'Stylesheet für das Framework-Frontend.';
        case 'json':
            return 'JSON-Konfigurations- oder Datendatei.';
        case 'md':
            return 'Markdown-Dokumentation oder Hinweise.';
        case 'html':
        case 'htm':
            return 'HTML-Template oder Beispielseite.';
        default:
            return 'Datei innerhalb des Frameworks.';
    }
}

function firstMeaningfulLine(string $content): string
{
    $lines = preg_split('/\n/', $content);

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if ($trimmed === '' || $trimmed === '<?php') {
            continue;
        }

        if (str_starts_with($trimmed, '<?php')) {
            $trimmed = substr($trimmed, 5);
            $trimmed = trim($trimmed);
        }

        if ($trimmed === '') {
            continue;
        }

        $trimmed = trim($trimmed, "/*#- \t\x0B\r\0\x0C");

        if ($trimmed !== '') {
            return mb_strimwidth($trimmed, 0, 140, '…');
        }
    }

    return '';
}

function languageHint(string $filePath): string
{
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    return match ($extension) {
        'php' => 'php',
        'js' => 'javascript',
        'css' => 'css',
        'json' => 'json',
        'html', 'htm' => 'html',
        'md' => 'markdown',
        'xml' => 'xml',
        'yml', 'yaml' => 'yaml',
        default => 'text',
    };
}

function writeLines($handle, array $lines): void
{
    fwrite($handle, implode("\n", $lines) . "\n");
}

function shouldDumpFile(SplFileInfo $fileInfo): bool
{
    $basename = $fileInfo->getBasename();

    if (strcasecmp($basename, '.DS_Store') === 0) {
        return false;
    }

    $extension = strtolower(pathinfo($basename, PATHINFO_EXTENSION));
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'ico', 'tiff', 'heic', 'avif'];

    return !in_array($extension, $imageExtensions, true);
}
