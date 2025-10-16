# Drupal Configuration Sync Directory Setup

## Overview
This document explains how to set up a secure configuration sync directory outside the web root for Drupal 11.

## Why Outside Web Root?
- **Security**: Prevents direct web access to sensitive configuration files
- **Best Practice**: Separates configuration from web-accessible content
- **Version Control**: Safe to commit config files without web exposure
- **Compliance**: Meets security standards for sensitive data protection

## Setup Instructions

### 1. Create Directory Structure
```bash
# From your Drupal project root (where composer.json is located)
mkdir -p config/sync
```

### 2. Set Proper Permissions
```bash
# Make directories readable and writable by web server
chmod 755 config
chmod 755 config/sync
```

### 3. Update settings.php
Add or modify this line in `web/sites/default/settings.php`:

```php
$settings['config_sync_directory'] = '../config/sync';
```

### 4. Verify Setup
- Ensure the directory exists: `ls -la config/sync/`
- Check permissions: Directory should be readable by web server
- Test configuration export/import in Drupal admin

## Directory Structure
```
drupal11-prep/
├── config/
│   ├── sync/           # Configuration files go here
│   └── sync.md         # This documentation
├── web/                # Web root (publicly accessible)
│   └── sites/default/
│       └── settings.php
└── composer.json
```

## Usage
- **Export Config**: Use Drupal admin UI or `drush config:export`
- **Import Config**: Use Drupal admin UI or `drush config:import`
- **Version Control**: Commit the `config/sync/` directory to your repository

## Security Notes
- The `../config/sync` path is relative to the web root, placing it outside web accessibility
- Never place sensitive configuration inside the `web/` directory
- Regularly backup your configuration files
- Use proper file permissions (755 for directories, 644 for files)

## Troubleshooting
- **Permission Errors**: Ensure web server can read/write to the directory
- **Path Issues**: Verify the relative path from web root to config directory
- **Import/Export Failures**: Check Drupal logs for specific error messages
