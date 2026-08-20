---
name: Architectural Precision
colors:
  surface: '#121316'
  surface-dim: '#121316'
  surface-bright: '#38393c'
  surface-container-lowest: '#0d0e10'
  surface-container-low: '#1a1c1e'
  surface-container: '#1e2022'
  surface-container-high: '#292a2c'
  surface-container-highest: '#343537'
  on-surface: '#e3e2e5'
  on-surface-variant: '#c3c6ce'
  inverse-surface: '#e3e2e5'
  inverse-on-surface: '#2f3033'
  outline: '#8d9198'
  outline-variant: '#43474d'
  surface-tint: '#aec8ee'
  primary: '#aec8ee'
  on-primary: '#153250'
  primary-container: '#0a2947'
  on-primary-container: '#7791b4'
  inverse-primary: '#466081'
  secondary: '#d3c5ab'
  on-secondary: '#382f1d'
  secondary-container: '#4f4632'
  on-secondary-container: '#c1b49a'
  tertiary: '#c7c8b4'
  on-tertiary: '#2f3224'
  tertiary-container: '#27291c'
  on-tertiary-container: '#8f907e'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#d2e4ff'
  primary-fixed-dim: '#aec8ee'
  on-primary-fixed: '#001c37'
  on-primary-fixed-variant: '#2e4868'
  secondary-fixed: '#f0e1c6'
  secondary-fixed-dim: '#d3c5ab'
  on-secondary-fixed: '#221b0a'
  on-secondary-fixed-variant: '#4f4632'
  tertiary-fixed: '#e3e4cf'
  tertiary-fixed-dim: '#c7c8b4'
  on-tertiary-fixed: '#1b1d10'
  on-tertiary-fixed-variant: '#464839'
  background: '#121316'
  on-background: '#e3e2e5'
  surface-variant: '#343537'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 72px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.04em
  display-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 40px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  meta-technical:
    fontFamily: JetBrains Mono
    fontSize: 14px
    fontWeight: '500'
    lineHeight: '1.5'
    letterSpacing: 0.05em
  label-caps:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '700'
    lineHeight: '1.2'
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 8px
  container-max: 1280px
  gutter: 24px
  margin-mobile: 20px
  margin-desktop: 64px
  section-gap: 120px
---

## Brand & Style

The design system is built for a personal portfolio that bridges the gap between technical expertise and editorial sophistication. The brand personality is professional, authoritative, yet forward-thinking, evoking an emotional response of trust and intellectual curiosity.

The design style is a hybrid of **Minimalism** and **Modern Corporate**, infused with subtle **Technical / Futuristic** detailing. It avoids the clichés of "gaming" futurism (neon, glows) in favor of "scientific" futurism—characterized by hairline borders, monospaced metadata, and structural grid lines. The aesthetic focuses on clarity, high-quality typography, and a "built" feel that suggests the work within is both intentional and precise.

## Colors

The palette is anchored by **Primary Navy**, used for deep immersive backgrounds and high-authority elements. **Warm Cream** serves as the primary "light" counterpoint, used for high-contrast sections and hero typography to ensure an editorial, premium feel. 

**Soft Sage** provides a muted, sophisticated surface color for UI components like cards and sidebars, preventing the interface from feeling too stark. **Warm Brown** is the functional accent, reserved for chronological indicators, interactive highlights, and technical "callouts" that require immediate focus without breaking the professional tone.

## Typography

This design system utilizes **Plus Jakarta Sans** for all major communication to maintain a modern, friendly but professional voice. **JetBrains Mono** is introduced as a secondary technical layer, used strictly for "meta" information such as dates, categories, section numbers, and code snippets.

The hierarchy is "top-heavy," with large display sizes for project titles and editorial headlines. Body text remains generous in line-height to ensure readability. All monospaced labels should be treated with increased letter-spacing to enhance the futuristic, data-driven aesthetic.

## Layout & Spacing

The layout follows a **Fixed Grid** model on desktop, centered with significant horizontal margins to create an "archival" feel. A 12-column grid is used, but content is often offset to create asymmetrical, editorial interest.

Vertical spacing is intentionally "airy." Sections are separated by large gaps (`120px+`) to allow the eye to rest and emphasize the importance of each piece of content. Hairline grid lines (0.5px or 1px) may be used to visually separate sections or define the grid boundaries, rendered in Soft Sage at low opacity (15-20%) against the Navy background.

## Elevation & Depth

This design system avoids heavy drop shadows and traditional z-axis depth. Instead, it uses **Tonal Layers** and **Low-Contrast Outlines**.

Hierarchy is established by the contrast between Navy and Sage surfaces. Depth is suggested through:
1.  **Framing:** Elements are often encased in fine 1px borders rather than being lifted by shadows.
2.  **Inlays:** "Card" elements should appear as subtle inlays or flat overlays with no blur.
3.  **Scrims:** When modals are required, use a solid color Navy overlay with 80% opacity rather than a blur, maintaining the crispness of the technical aesthetic.

## Shapes

The shape language is "architectural." Corners are predominantly **Soft (0.25rem)** to maintain a professional edge without feeling aggressive. 

Strict geometric shapes are preferred. Buttons and input fields should use the base roundedness, while small tags or "status indicators" may use 0px (sharp) corners to reinforce the technical/blueprint feel of the system.

## Components

### Buttons
Primary buttons use the **Warm Brown** accent with white or cream text. They are flat, with no gradients. The hover state involves a slight color shift or the addition of a technical corner-bracket icon. Secondary buttons are outlined with 1px Soft Sage borders.

### Cards
Portfolio cards use the **Soft Sage** color as a background when on Navy, or Navy when on Cream. They feature a 1px border and a monospaced "Project ID" or "Year" in the top right corner.

### Metadata Labels
Small, pill-like or rectangular labels using **JetBrains Mono**. These should be used for tech stacks, categories, and timeline markers.

### Timeline Indicators
The **Warm Brown** color is used for vertical lines and nodes in the experience section. Lines should be thin (1px) and nodes should be small, unfilled circles.

### Input Fields
Inputs are minimal: a bottom-border only or a very light Sage outline. Labels should be monospaced and positioned above the field.

### Section Numbering
Every major section should be prefaced with a monospaced number (e.g., // 01, // 02) in **Warm Brown** to enhance the technical, structured narrative.