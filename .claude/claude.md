# Barringtons Funeral Services - Project Instructions

## CRITICAL: JSON Content Management

**Before starting any development:**
Remind the user to download ALL JSON content from production and overwrite local content folder.

**When committing to GitHub:**
ALWAYS commit ALL JSON files (content/*.json), even if you only changed one file.
This ensures GitHub has complete current state and prevents stale content from being deployed.

**Why:** Production (cPanel) is source of truth. GitHub deploys ALL files on every push.
Stale JSON in Git will overwrite current production content.
