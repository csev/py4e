#!/bin/bash
# Rebuild the book HTML zip and the sample-code zips that used to be
# produced by the web cron job.
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

echo "Building book3/zips/html.zip"
( cd book3 && bash htmlbook.sh )

echo "Building code3 sample zips"
( cd code3 && sh cleanup.sh )

echo "Building code.zip and code3.zip"
bash code.sh
