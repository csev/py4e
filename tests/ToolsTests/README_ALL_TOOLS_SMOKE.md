# AllToolsSmokeTest - Comprehensive Tool Testing

## Overview

`AllToolsSmokeTest` automatically discovers all tools from the `/tools` store listing and runs `BaseToolTest` on each one. This provides comprehensive smoke testing coverage of all installed tools.

## Features

- ✅ **Auto-discovery**: Finds all tools from store markup
- ✅ **Comprehensive testing**: Runs full BaseToolTest suite on each tool
- ✅ **Quick mode**: Option to test only store listing (faster)
- ✅ **Limit option**: Test only first N tools
- ✅ **Summary report**: Shows pass/fail statistics

## Usage

### Test All Tools (Full Test)

```bash
php tests/ToolsTests/AllToolsSmokeTest.php
```

This will:
1. Discover all tools from `/tools` store
2. Run full tests on each tool:
   - Store listing check
   - Tool launch via "Try It"
   - All four identities (Jane Instructor, Sue Student, Ed Student, Anonymous)

**Note**: This can take a while (26 tools × ~30 seconds each = ~13 minutes)

### Quick Mode (Store Listing Only)

```bash
php tests/ToolsTests/AllToolsSmokeTest.php --quick
```

Only tests that tools appear in store listing. Much faster (~1-2 minutes for 26 tools).

### Limit Number of Tools

```bash
# Test only first 5 tools
php tests/ToolsTests/AllToolsSmokeTest.php --limit=5

# Quick test first 10 tools
php tests/ToolsTests/AllToolsSmokeTest.php --quick --limit=10
```

### Watch Mode

```bash
php tests/ToolsTests/AllToolsSmokeTest.php --watch
```

Shows browser window so you can watch tests progress.

## Options

- `--quick` or `-q`: Quick mode (store listing only)
- `--limit=N`: Limit to first N tools
- `--watch`: Show browser window
- `--help` or `-h`: Show usage information

## Example Output

```
=== Discovering All Tools ===

   Found 26 tool cards
     - aipaper (AI Paper)
     - agree (Agreement Tool)
     - breakout (Breakout)
     ...

=== Running Smoke Tests on 26 Tools ===

=== Testing Tool: aipaper (AI Paper) ===
✓ Tool 'aipaper' found in store listing
   Navigating to tool details...
   Clicking 'Try It' button...
   Waiting for tool to launch in iframe...
✓ Tool launched successfully via 'Try It'
   Content length: 1234 chars
   Testing identity: Jane Instructor...
     ✓ Jane Instructor: Tool launched successfully (1234 chars)
   Testing identity: Sue Student...
     ✓ Sue Student: Tool launched successfully (1234 chars)
  ✓ Tool 'aipaper' - All tests passed (3/3)

...

=== Test Summary ===
Total tools discovered: 26
Tools passed: 24
Tools failed: 2
Success rate: 92.3%

Failed tools: tool1, tool2
```

## Integration

Add to your test suite:

```bash
# In run-all.php or similar
php tests/ToolsTests/AllToolsSmokeTest.php --quick
```

## When to Use

- **Pre-deployment**: Quick smoke test of all tools
- **CI/CD**: Automated testing of tool installations
- **Tool discovery**: Verify all tools are properly registered
- **Regression testing**: Ensure tool launches still work after changes

## Performance

- **Full test**: ~30 seconds per tool (26 tools = ~13 minutes)
- **Quick mode**: ~2-3 seconds per tool (26 tools = ~1-2 minutes)

Use `--quick` for faster feedback, `--limit=N` to test subset, or run full tests overnight/CI.
