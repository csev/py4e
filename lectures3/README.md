# PPTX to PDF Conversion Script

## Overview

The `convert2pdf.sh` script converts all `.pptx` files in the current directory and its subdirectories into PDF format using LibreOffice’s command-line interface.

Each converted PDF is saved in a `pdf` subdirectory located in the same directory as its source `.pptx` file. If the `pdf` directory does not exist, it is created automatically.

---

## Requirements

### LibreOffice

LibreOffice must be installed and accessible from the command line.

Verify installation:

```bash
soffice --version
```

Expected output (example):

```
LibreOffice 24.2.7.2 420(Build:2)
```

---

## Installation

### Linux (Debian/Ubuntu)

```bash
sudo apt install libreoffice
```
For installation on other Linux distributions, refer to your particular Linux distribution's documentation as noted
[here](https://www.libreoffice.org/get-help/install-howto/linux/).

### macOS

#### Homebrew

```bash
brew install --cask libreoffice
```

#### MacPorts

```bash
sudo port install libreoffice
```

---

## macOS Path Configuration

On macOS, the `soffice` binary is located at:

```
/Applications/LibreOffice.app/Contents/MacOS/soffice
```

Ensure this path is included in your system `PATH` environment variable, or update the script accordingly.

---

## How It Works

* Recursively searches for `.pptx` files starting from the current directory
* Converts each file to PDF using LibreOffice in headless mode
* Outputs each PDF into a `pdf/` subdirectory alongside the original file

---

## Java Note

LibreOffice may attempt to locate a Java Runtime Environment (JRE) at startup.

* Java is **not required** for basic `.pptx` to PDF conversion
* A warning may appear if Java is not configured:

  ```
  Warning: failed to launch javaldx - java may not function correctly
  ```

To suppress this warning, you may optionally set the `JAVA_HOME` environment variable:

```bash
export JAVA_HOME=/usr/lib/jvm/default-java
```

This step is optional and does not affect conversion functionality. Note
the script will automatically attempt to locate Java and set the `JAVA_HOME`
environment variable. If it cannot locate Java it will continue without it.

---

## Usage

Run the script from the directory containing your PowerPoint files:

```bash
./convert2pdf.sh
```

The script will process all `.pptx` files found in the current directory and its subdirectories.

---

## Notes
* There's no official doc for the CLI convert to filter option names that correspond to the Impress UI options
, but the option names can be found in the [source code](https://opengrok.libreoffice.org/xref/core/filter/source/pdf/). Look in files
`pdfexport.cxx` and `impdialog.cxx`.
* The script assumes `.pptx` files are valid and readable by LibreOffice
* Output PDFs will overwrite existing files with the same name in the `pdf` directory
* Font availability on the system may affect final rendering in the PDF
