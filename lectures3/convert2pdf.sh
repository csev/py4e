#!/usr/bin/env bash
# ##############################################################
# Note: This script Requires LibreOffice to be installed:
# https://www.libreoffice.org/get-help/install-howto/
#
# You can determine whether it is installed run the following command:
#   - soffice --version
# The expected output is similar to:
#   LibreOffice 24.2.7.2 420(Build:2)
#
# To install LibreOffice on Linux use the packages tailored to your system's 
# packaging standard (RPM or deb). For example, on Debian systems such as
# Ubuntu, use the CLI command: 
#   - sudo apt install libreoffice
#
# On macOS use either Homebrew or MacPorts CLI:
#   - Homebrew command: brew install --cask libreoffice
#   - MacPorts command: sudo port install libreoffice
# 
# The soffice command used by this script is located in
# /Applications/LibreOffice.app/Contents/MacOS/soffice
# on macOS. Verify that it is in your path.
# 
# More information is provided in README.md.
#   
# ##############################################################
#
# Converts all .pptx files in the current directory and its subdirectories
# to PDF by using LibreOffice's command-line interface. The converted
# PDFs are saved in a "pdf" subdirectory within the same directory as 
# the original .pptx file. If the "pdf" subdirectory does not exist,
# it will be created. 
#
# Note: LibreOffice may require Java for certain features, but for basic pptx to pdf conversion,
# Java is not typically required. However, if you encounter issues with LibreOffice,
# you may need to set JAVA_HOME to point to your Java installation.

# Set JAVA_HOME if not already set, to ensure LibreOffice can find Java if needed.
# Note, it's unlikely the Java is needed for the conversion process, but setting it
# eliminate's a warning message that displays even when it's not needed.
if [ -z "$JAVA_HOME" ]; then
    DEFAULT_JAVA_HOME=$(readlink -f $(which java) | sed "s:bin/java::")
    if [ -z "$DEFAULT_JAVA_HOME" ]; then
        echo "Warning: Could not determine JAVA_HOME"
        echo "Please set JAVA_HOME manually if you encounter issues with LibreOffice."
    else
        echo "Detected JAVA_HOME: $DEFAULT_JAVA_HOME"
    fi
else
    echo "Using existing JAVA_HOME: $JAVA_HOME"
fi

# Check if soffice (LibreOffice) is installed and available in the PATH
SOFFICE_PATH=$(which soffice)
if [ -z "$SOFFICE_PATH" ]; then
    echo "Error: LibreOffice (soffice) not found."
    echo "Please install LibreOffice and ensure it's in the PATH."
    exit 1
fi

# Find all .pptx files recursively starting from the current directory
pptx_files=$(find . -type f -name "*.pptx")

count=0
error_count=0

# Convert each pptx file to pdf
for pptx_file in $pptx_files; do
    # Get the directory containing the pptx file
    dir=$(dirname "$pptx_file")
    echo "Processing directory: $dir"
    
    # Get the filename without extension
    filename=$(basename "$pptx_file" .pptx)
    
    # Create pdf subdirectory if it doesn't exist
    pdf_dir="$dir/pdf"
    mkdir -p "$pdf_dir"
    if [ $? -ne 0 ]; then
        echo "Error creating directory: $pdf_dir"
        error_count=$((error_count + 1))
        continue
    fi

    # Define output PDF path
    pdf_file="$pdf_dir/$filename.pdf"
    
    # Convert pptx to PDF
    echo "Converting: $pptx_file to $pdf_file"
    "$SOFFICE_PATH" --headless --convert-to pdf:impress_pdf_Export:{"PDFUACompliance":true,"UseTaggedPDF":true,"ReduceImageResolution":true,"MaxImageResolution":300,"UseLosslessCompression":false,"Quality":90} --outdir "$pdf_dir" "$pptx_file"

    if [ $? -eq 0 ]; then
        echo "Successfully converted: $pptx_file"
        count=$((count + 1))
    else
        echo "Error converting: $pptx_file"
        error_count=$((error_count + 1))
    fi
done

echo "Conversion complete! $count files converted, $error_count files failed."