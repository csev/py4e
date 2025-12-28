# Python for Everybody - Filipino-English (Taglish) Translation

This folder contains the Filipino-English (Taglish) translation of "Python for Everybody" book.

## Language Code

`tl` is the ISO 639-1 language code for Tagalog/Filipino.

## Building the Book

To build the PDF from this folder:

```bash
cd book-tl
bash book.sh
```

This will generate `x.pdf` in the `book-tl` directory.

## Files

- All `.mkd` files contain the translated content
- `book.sh` - Build script for generating PDF
- `template.latex` - LaTeX template (modified to fix `\pandocbounded` command)
- `texpatch.py` - Post-processing script for LaTeX output
- Other supporting files for EPUB and other formats

## Translation Status

All 16 chapters plus preface, contributions, and copyright sections have been translated from English to Filipino-English (Taglish).

## Notes

- The `template.latex` file has been modified to ensure the `\pandocbounded` command is always defined, even if pandoc doesn't detect graphics properly.
- Image paths use `../images/` which works correctly since `book-tl` is at the same level as `book3`.

