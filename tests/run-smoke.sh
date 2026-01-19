#!/bin/bash
# Quick smoke test runner
# Usage: ./tests/run-smoke.sh [--watch]
#   --watch: Show browser window (watch tests as they run)

cd "$(dirname "$0")/.."

if [ "$1" == "--watch" ]; then
    echo "Running Py4E Smoke Tests in WATCH MODE..."
    echo "Browser window will be visible - you can watch the tests run!"
    echo "Make sure your server is running at http://localhost:8888/py4e/"
    echo ""
    php tests/SmokeTest.php --watch
else
    echo "Running Py4E Smoke Tests..."
    echo "Make sure your server is running at http://localhost:8888/py4e/"
    echo "(Use --watch flag to see browser window)"
    echo ""
    php tests/SmokeTest.php
fi

exit $?
