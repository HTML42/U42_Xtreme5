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
    if ($fileInfo->isFile()) {
        $files[] = $fileInfo->getPathname();
    }
}

sort($files, SORT_STRING);

$markdown = [];
$markdown[] = '# Latest framework dump';
$markdown[] = 'Erzeugt am ' . date(DATE_ATOM);
$markdown[] = '';

foreach ($files as $filePath) {
    $relativePath = 'latest/' . ltrim(str_replace($sourceDirectory, '', $filePath), DIRECTORY_SEPARATOR);
    $content = file_get_contents($filePath);

    if ($content === false) {
        $markdown[] = "## {$relativePath}";
        $markdown[] = '';
        $markdown[] = '_Datei konnte nicht gelesen werden._';
        $markdown[] = '';
        continue;
    }

    $normalizedContent = str_replace(["\r\n", "\r"], "\n", $content);

    $description = buildDescription($relativePath, $normalizedContent);
    $language = languageHint($filePath);

    $markdown[] = "## {$relativePath}";
    if ($description !== '') {
        $markdown[] = "- Kurzbeschreibung: {$description}";
        $markdown[] = '';
    }

    $markdown[] = "```{$language}";
    $markdown[] = $normalizedContent;
    $markdown[] = '```';
    $markdown[] = '';
}

$written = file_put_contents($outputFile, implode("\n", $markdown));

if ($written === false) {
    fwrite(STDERR, "Konnte Ausgabedatei nicht schreiben: {$outputFile}\n");
    exit(1);
}

echo "Dump erstellt: {$outputFile}\n";

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
