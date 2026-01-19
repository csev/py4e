#!/bin/bash
# Cleanup script to kill stuck test processes

echo "Cleaning up test processes..."

# Kill ChromeDriver processes
CHROMEDRIVER_PIDS=$(pgrep chromedriver)
if [ ! -z "$CHROMEDRIVER_PIDS" ]; then
    echo "Killing ChromeDriver processes: $CHROMEDRIVER_PIDS"
    pkill chromedriver
    sleep 1
fi

# Kill PHP processes that are connected to ChromeDriver port
PHP_PIDS=$(lsof -ti :9515 2>/dev/null | grep -v "^$" || true)
if [ ! -z "$PHP_PIDS" ]; then
    echo "Killing PHP processes connected to port 9515: $PHP_PIDS"
    echo "$PHP_PIDS" | xargs kill 2>/dev/null || true
    sleep 1
fi

# Final check
if lsof -i :9515 >/dev/null 2>&1; then
    echo "⚠ Port 9515 still in use. Force killing..."
    lsof -ti :9515 | xargs kill -9 2>/dev/null || true
    pkill -9 chromedriver 2>/dev/null || true
    sleep 1
fi

# Verify cleanup
if lsof -i :9515 >/dev/null 2>&1; then
    echo "✗ Port 9515 still in use:"
    lsof -i :9515
    exit 1
else
    echo "✓ Port 9515 is free"
    exit 0
fi
