# Project Overview

**Car Empire** is a browser-based simulation and economy game centered around cars, ownership, services, and long-term progression.  
The game focuses on **system depth, decision-making, and economic interaction** rather than 3D graphics or real-time action.

Players do not only race cars. They **build, repair, trade, manage workshops, participate in events, and operate within a dynamic, time-based economy**.  
Every action has consequences, costs time, and contributes to skill growth and reputation.

---

# Vision & Design Philosophy

Car Empire is designed as a **classic browser game with modern systems**:
- Click-based interactions
- Clear UI-driven gameplay
- Strong simulation depth
- Long-term progression without real-time pressure

The core idea is:
> **Time is the most valuable resource. Money accelerates progress, but decisions define success.**

---

# UI & Color Style

The interface leans into a **clean, technical cockpit look** with calm base tones and vibrant accents.

- **Primary (Midnight Navy)**: `#1B263B`
- **Primary Light (Steel Blue)**: `#415A77`
- **Secondary (Turbo Teal)**: `#2EC4B6`
- **Secondary Light (Ice Mint)**: `#9FF1E6`

This palette keeps the UI readable, highlights actions clearly, and fits the theme of precision and performance.

---

# Game Concept

Players own one or more cars, each composed of multiple components and attributes such as condition, class, and market value.  
Cars can be:
- Bought and sold
- Repaired and upgraded
- Customized and restored
- Entered into events
- Used as trade or showcase assets

Income can be generated through **multiple paths**, including racing events, trading, services, and market opportunities.

The game intentionally avoids a single dominant playstyle.

---

# Core Gameplay Loop

1. Discover cars and parts  
   - NPC dealers  
   - Online car portal  
   - Scrapyard (randomized finds)

2. Evaluate and decide  
   - Repair, upgrade, or restore  
   - Sell immediately or invest further

3. Execute actions  
   - Workshop jobs  
   - Events  
   - Trading or cross-country transport

4. Earn rewards  
   - Coins  
   - Experience  
   - Reputation

5. Reinvest  
   - Skills  
   - Workshop capacity  
   - Garage expansion  
   - Market positioning

---

# Core Gameplay Pillars

## Car Ownership & Customization
- Multiple cars per player
- Individual condition and value
- Parts, upgrades, and restoration
- Long-term asset management

## Economy & Trading
- NPC dealers with rotating inventories
- Player-driven buy/sell decisions
- Market value vs. actual price
- Country-based markets with import/export mechanics

## Skill-Based Services
- Repairing, upgrading, painting, and restoring
- Player-operated workshops
- Services can be offered to other players
- Reputation and demand emerge naturally

## Events & Reputation
- Racing and non-racing car events
- Class-based and theme-based requirements
- Rewards depend on car quality and player skills
- Rankings and visibility over time

## Time & Resource Management
- Every action consumes time
- Players are blocked while performing actions
- Parallel actions are limited by skills and upgrades
- Planning and prioritization are essential

---

# World, Markets & Regions

Car Empire features a **simulated world economy**:

- Markets are **country-based**
- Each country has:
  - Its own dealers
  - Its own portal listings
  - Its own events and scrapyard pools

Content is generated:
- Daily (portal listings, scrapyard attempts, events)
- Weekly (dealer inventories)

### Cross-Country Trading
- Cars can be bought across countries
- Transport takes time
- Additional fees apply
- Rare or unique vehicles may only appear in specific regions

---

# Player Roles & Playstyles

Players naturally specialize through their actions:

- **Racer** – focuses on events and performance
- **Mechanic** – repairs and upgrades cars for profit
- **Trader / Dealer** – buys low, sells high across markets
- **Workshop Operator** – provides services to others
- **Collector** – restores and showcases rare vehicles

No role is exclusive. Players can switch or combine roles, but specialization provides efficiency.

---

# Skill System

Skills are grouped into categories and increase **only through use**.

### Skill Categories
- Technical Skills (repair, tuning, restoration)
- Business Skills (management, efficiency)
- Sales & Dealer Skills (negotiation, appraisal)
- Logistics & Operations (transport, scheduling)
- Social & Reputation Skills (customer relations)

### Skill Effects
- Reduced action durations
- Better prices and margins
- Higher quality outcomes
- Increased capacity and efficiency

Skills modify base values but never remove time costs entirely.

---

# Time, Actions & Blocking

- Every meaningful action has a duration
- While performing an action:
  - The player is blocked
  - Cars involved are unavailable
- Actions include:
  - Workshop jobs
  - Events
  - Transport
  - Large market deals

This system ensures:
- No instant progress
- No idle grinding
- Clear trade-offs between speed and planning

---

# Monetization (Planned, Fair & Optional)

Monetization is designed as **pay-for-speed and convenience**, not pay-to-win.

### Credits
Credits can be obtained via:
- Optional advertising
- Referral of active players
- Direct purchase

### Time Acceleration Rules
- Each action can be shortened **up to two times**
- Each step reduces duration by **10%**
- Maximum reduction: **20%**

Ways to accelerate:
- Small ad → +1 Credit
- Large ad → applies one 10% reduction directly
- 2 Credits → one 10% reduction

Credits cannot improve results, only reduce waiting time.

---

# Technical Overview

Car Empire is built using **Xtreme Webframework 5**.

- Browser-based, hash-routing (`#!controller/view`)
- Clear separation between:
  - UI (Controllers & Templates)
  - Backend Objects (API endpoints)
  - Domain logic (PHP classes)
- No external services required
- Lightweight and maintainable architecture

---

# Privacy & Tracking

- No tracking
- No analytics
- No external telemetry
- No hidden data collection

Privacy is a core design decision.

---

# Non-Goals (Out of Scope for Now)

- No 3D graphics
- No real-time multiplayer
- No physics-based driving
- No external APIs
- No mandatory monetization
- No tracking or analytics

---

# Project Status

The project is currently in the **foundation and architecture phase**.

- Core structure is being established
- Legal pages and base navigation are in place
- Backend API groundwork is implemented
- No gameplay UI is finalized yet

The current focus is on **clean architecture, long-term scalability, and solid fundamentals** before feature expansion.
