#!/usr/bin/env bash
# ##############################################################
# Note: This script Requires LibreOffice to be installed:
# https://www.libreoffice.org/get-help/install-howto/
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
    "$SOFFICE_PATH" --headless --convert-to pdf --outdir "$pdf_dir" "$pptx_file"
    if [ $? -eq 0 ]; then
        echo "Successfully converted: $pptx_file"
        count=$((count + 1))
    else
        echo "Error converting: $pptx_file"
        error_count=$((error_count + 1))
    fi
done

echo "Conversion complete! $count files converted, $error_count files failed."