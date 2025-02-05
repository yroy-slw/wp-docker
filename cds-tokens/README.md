# cds-tokens

## Overview
The `cds-tokens` package manages design tokens for the CDS design system. It integrates **Figma**, **Tokens Studio**, **GitHub**, and **Style Dictionary** to generate CSS and SCSS variables for use in the WordPress theme.

## Workflow

1. **Manage Tokens in Figma**
   - Design tokens are created and updated using **Tokens Studio** in Figma.

2. **Sync with GitHub**
   - Tokens Studio is configured to sync design tokens with a GitHub repository.
   - Syncing creates a **Pull Request (PR)** with the updated token files.

3. **Build Tokens with Style Dictionary**
   - After merging the PR, **Style Dictionary** processes the tokens and generates CSS/SCSS variables.

4. **Copy Tokens to the Theme**
   - The generated variables are copied to the WordPress theme directory for integration.

## Installation
Ensure you have **Node.js** installed, then run:

```sh
npm install
```

## Usage

### Build Tokens
To generate CSS and SCSS variables from the tokens:

```sh
npm run build:tokens
```

This will:
1. Use **Style Dictionary** to process tokens from `tokens/*.json`.
2. Output CSS and SCSS variables to `build/css/_variables.css` and `build/scss/_variables.scss`.
3. Copy these files to the theme directory.

### Clean Build
Before running a new build, you can remove the previous token files:

```sh
npm run prebuild:tokens
```

## Folder Structure
```
cds-tokens/
├── tokens/             # JSON token files synced from Tokens Studio
├── build/              # Generated CSS/SCSS variables
├── config.json         # Style Dictionary configuration
├── package.json        # Project dependencies and scripts
└── README.md           # This file
```

## Customization
You can modify `config.json` to adjust the output formats and paths.

## Contributing
- Sync tokens from **Tokens Studio**.
- Open a **Pull Request (PR)** when changes are made.
- Review and merge PRs before running `npm run build:tokens`.

## License
MIT License
