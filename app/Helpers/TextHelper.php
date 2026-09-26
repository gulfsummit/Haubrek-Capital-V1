<?php

namespace App\Helpers;

class TextHelper
{
    /**
     * Clean text content by replacing problematic characters
     */
    public static function cleanText($text)
    {
        if (!$text) return $text;
        
        // First, normalize the encoding
        $text = mb_convert_encoding($text, 'UTF-8', 'auto');
        
        // Replace problematic Unicode characters
        $replacements = [
            // Smart quotes (various Unicode points)
            "\u{201C}" => '"',   // Left double quotation mark
            "\u{201D}" => '"',   // Right double quotation mark
            "\u{2018}" => "'",   // Left single quotation mark
            "\u{2019}" => "'",   // Right single quotation mark
            
            // Dashes
            "\u{2013}" => '-',   // En dash
            "\u{2014}" => '-',   // Em dash
            "\u{2015}" => '-',   // Horizontal bar
            
            // Other problematic characters
            "\u{2026}" => '...',  // Horizontal ellipsis
            "\u{2022}" => '*',    // Bullet
            "\u{00AE}" => '(R)',  // Registered trademark
            "\u{2122}" => '(TM)', // Trademark
            "\u{00A9}" => '(C)',  // Copyright
            
            // Decorative asterisks and symbols
            "\u{273D}" => '*',    // Heavy teardrop-spoked asterisk
            "\u{274B}" => '*',    // Heavy eight-teardrop-spoked propeller asterisk
            "\u{2731}" => '*',    // Heavy asterisk
            "\u{2605}" => '*',    // Black star
            "\u{2606}" => '*',    // White star
            
            // Additional problematic characters
            "\u{00A0}" => ' ',    // Non-breaking space
            "\u{200B}" => '',     // Zero-width space
            "\u{FEFF}" => '',     // Byte order mark
        ];
        
        // Apply replacements
        foreach ($replacements as $search => $replace) {
            $text = str_replace($search, $replace, $text);
        }
        
        // Also try with hex codes for stubborn characters
        $text = str_replace([
            chr(226).chr(128).chr(156), // Left double quote
            chr(226).chr(128).chr(157), // Right double quote
            chr(226).chr(128).chr(152), // Left single quote
            chr(226).chr(128).chr(153), // Right single quote
            chr(226).chr(128).chr(147), // Em dash
            chr(226).chr(128).chr(148), // En dash
        ], ['"', '"', "'", "'", '-', '-'], $text);
        
        // Remove any remaining non-printable characters except basic punctuation
        $text = preg_replace('/[\x00-\x1F\x7F-\x9F]/u', '', $text);
        
        return trim($text);
    }
    
    /**
     * Convert text to use standard ASCII characters only
     */
    public static function toAscii($text)
    {
        // First clean with our method
        $text = self::cleanText($text);
        
        // Then convert to ASCII
        return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    }
    
    /**
     * Clean text specifically for web display
     */
    public static function cleanForWeb($text)
    {
        $text = self::cleanText($text);
        
        // Ensure proper HTML encoding
        $text = htmlspecialchars_decode($text, ENT_QUOTES);
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        
        return $text;
    }
}