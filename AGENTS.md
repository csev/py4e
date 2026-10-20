# Repository Guidelines

## Git hooks

The book and sample-code zip files are rebuilt by a local pre-commit hook. Git does not enable hooks on a fresh checkout, and GitHub does not run this hook.

At the start of every Cursor session, verify the hook and install it when it is missing. See `.cursor/rules/git-hooks.mdc`.

```bash
test -x .git/hooks/pre-commit && grep -q 'make-zips.sh' .git/hooks/pre-commit || bash qa/install-git-hooks.sh
```

`bash qa/install-git-hooks.sh` copies `.githooks/pre-commit` into `.git/hooks/pre-commit`. When a commit includes book sources or sample code, that hook runs `book3/make-zips.sh` and stages the new zips into the same commit.
