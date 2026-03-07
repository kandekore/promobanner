# Promo Launch Banner for Elementor

A custom Elementor widget that renders a full-width promotional banner with a live countdown timer, pricing panel, circular image cluster, and configurable call-to-action buttons.

---

## Features

- Live countdown timer with gradient styling and a configurable sale badge
- Prominent pricing panel with sale price, struck-through regular price, and supporting text
- Two call-to-action buttons: one Elementor popup trigger, one telephone link
- Circular overlapping image cluster on the right
- Fully responsive (tablet and mobile breakpoints)
- All content and colours configurable inside Elementor — no code editing required

---

## Requirements

| Requirement | Version |
|---|---|
| WordPress | 5.6 or higher |
| Elementor (free) | 3.0 or higher |
| Elementor Pro | Required for popup trigger functionality |
| PHP | 7.4 or higher |

---

## Installation

1. Download or clone this repository into your WordPress plugins directory:
   ```
   wp-content/plugins/promobanner/
   ```
2. In the WordPress admin go to **Plugins → Installed Plugins** and activate **Promo Launch Banner for Elementor**.
3. Open any page in Elementor, search for **"Promo Launch Banner"** in the widget panel, and drag it onto the canvas.

---

## Widget Controls

### Content Tab

#### Countdown
| Field | Description |
|---|---|
| Launch Date & Time | The target date/time the countdown counts down to |
| Sale Badge Text | Short label shown inside the countdown bar (e.g. `Sale`). Leave empty to hide the badge |

#### Heading
| Field | Description |
|---|---|
| Heading | Main promotional headline displayed below the countdown |

#### Pricing
| Field | Description | Example |
|---|---|---|
| Sale Price | The current/discounted price | `£549` |
| Price Suffix | Text appended inline after the sale price | `+VAT` |
| Regular / Old Price | The original price, displayed struck through | `£700+VAT` |
| Pricing Info – Line 1 | First line of supporting text to the right of the prices | `Limited Time Special Offer` |
| Pricing Info – Line 2 | Second line of supporting text | `Book Before 28th February` |

#### Button 1 (Popup)
| Field | Description |
|---|---|
| Button 1 Text | Label for the primary call-to-action button |
| Button 1 – Elementor Popup ID | The numeric ID of your Elementor Pro popup template. The button will trigger it using Elementor's native popup action URL |

**How to find the Popup ID:**
Go to **Templates → Popups** in the WordPress admin. Hover over the popup and look at the URL in the status bar — the number after `post=` is the ID. Alternatively, open the popup for editing and note the number in the browser address bar.

#### Button 2 (Phone)
| Field | Description |
|---|---|
| Button 2 Text | Optional label shown before the number (e.g. `Call Us`) |
| Phone Number | The phone number to display and dial (e.g. `0800 118 2589`). Non-numeric characters are stripped for the `tel:` href automatically |

#### Images
| Field | Description |
|---|---|
| Circle Image 1 | Top-centre circle (smallest, front layer) |
| Circle Image 2 | Bottom-left circle (largest, middle layer) |
| Circle Image 3 | Right circle (medium, back layer) |

All three images are cropped to circles with `object-fit: cover`.

---

### Style Tab

| Field | Description |
|---|---|
| Background | Full background of the banner — supports solid colour, gradient, or image via Elementor's background group control |
| Circle Border Colour | Colour of the border ring around each circle image (default: white) |

> The countdown gradient, pricing panel colour, sale price colour, and button colours are defined in `assets/css/promo-banner.css` and can be adjusted there if needed.

---

## Key Colour Reference

| Element | CSS Class | Default Colour |
|---|---|---|
| Countdown gradient start | `.promo-countdown` | `#0d1b6e` (dark navy) |
| Countdown gradient end | `.promo-countdown` | `#1976d2` (medium blue) |
| Sale badge | `.promo-sale-badge` | `#ff3b6b` (pink) |
| Sale price text | `.sale-price` | `#ff3b6b` (pink) |
| Pricing panel background | `.promo-pricing` | `#0d1b6e` (dark navy) |
| Primary button | `.promo-btn` | `#ff3b6b` (pink) |
| Phone button | `.promo-btn.phone-btn` | `#1565c0` (blue) |

---

## Responsive Behaviour

| Breakpoint | Behaviour |
|---|---|
| > 1024px | Two-column layout: text left, image cluster right |
| ≤ 1024px | Single column, content stacks vertically, pricing panel centred |
| ≤ 600px | Further reduced font sizes, buttons go full width |

---

## File Structure

```
promobanner/
├── promo-launch-banner.php       # Main plugin file — registers assets and widget
├── widgets/
│   └── promo-banner-widget.php  # Elementor widget: controls + render
├── assets/
│   ├── css/
│   │   └── promo-banner.css     # All widget styles
│   └── js/
│       └── promo-countdown.js   # Countdown timer logic
└── README.md
```

---

## How the Popup Trigger Works

When a popup ID is entered, the button href is built as:

```
#elementor-action:action=popup:open&settings=BASE64_ENCODED_JSON
```

Where the encoded JSON is `{"id":"YOUR_ID","toggle":false}`. This is Elementor Pro's native popup trigger format and works alongside any display conditions you have set on the popup — no extra JavaScript required.

---

## Customising Styles

All styles live in `assets/css/promo-banner.css`. The file is registered via `wp_register_style` and only enqueued when the widget is present on the page (Elementor handles this automatically via `get_style_depends`).

To override styles from a theme or child theme without editing the plugin file, add your overrides with a higher specificity selector, for example:

```css
.elementor-widget-promo_launch_banner .sale-price {
    color: #your-colour;
}
```

---

## Changelog

### 1.0.1
- Added countdown gradient (dark navy to medium blue)
- Added configurable Sale badge inside countdown
- Redesigned pricing panel with dark blue background, prominent sale price, and struck-through regular price
- Added Elementor popup trigger support for Button 1
- Added phone number button (Button 2) with `tel:` link
- Added Pricing Info Line 2 field
- Improved mobile responsiveness

### 1.0.0
- Initial release

---

## Author

Developed by D Kandekore.
