#!/bin/bash
# Run tests in watch mode (visible browser)
# Usage: ./tests/run-watch.sh

cd "$(dirname "$0")/.."

echo "👀 Running tests in WATCH MODE"
echo "Browser window will be visible - watch tests as they run!"
echo "Make sure your server is running at http://localhost:8888/py4e/"
echo "Press Ctrl+C to stop"
echo ""

php tests/SmokeTest.php --watch

exit $?
