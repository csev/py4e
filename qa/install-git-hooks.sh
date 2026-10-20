#!/usr/bin/env bash
# Copy the versioned pre-commit hook into this clone. Git does not install
# hooks on checkout, so a fresh clone needs this once.
set -euo pipefail

root="$(cd "$(dirname "$0")/.." && pwd)"
cd "$root"

src=".githooks/pre-commit"
dst=".git/hooks/pre-commit"

if [ ! -d .git ]; then
    echo "No .git directory here. Run this inside a checkout." >&2
    exit 1
fi

mkdir -p .git/hooks
cp "$src" "$dst"
chmod +x "$dst" "$src"

echo "pre-commit hook installed at .git/hooks/pre-commit"
echo "It rebuilds the book and sample-code zips when those sources are committed."
