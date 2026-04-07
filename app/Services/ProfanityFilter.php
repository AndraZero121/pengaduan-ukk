<?php

namespace App\Services;

class ProfanityFilter
{
    /**
     * List of common bad words/slang (Indonesian and English).
     *
     * @var array<string>
     */
    protected array $badWords = [
        // Indonesian (commonly used in school context)
        'anjing', 'babi', 'monyet', 'kunyuk', 'asu',
        'bangsat', 'brengsek', 'bajingan', 'tolol', 'goblok', 'bego',
        'peler', 'memek', 'kontol', 'jembut', 'itil', 'ngentot', 'entot',
        'pantek', 'puki', 'lonte', 'jablay', 'perek',
        'setan', 'iblis', 'dajjal', 'modar', 'mampus',

        // English
        'fuck', 'shit', 'asshole', 'bitch', 'damn', 'crap',
        'piss', 'bastard', 'dick', 'pussy', 'cock',
    ];

    /**
     * Filter the given text by replacing bad words with asterisks.
     */
    public function filter(string $text): string
    {
        foreach ($this->badWords as $word) {
            $replacement = str_repeat('*', strlen($word));
            $text = preg_replace('/\b'.preg_quote($word, '/').'\b/i', $replacement, $text);
        }

        return $text;
    }

    /**
     * Check if the given text contains any bad words.
     */
    public function containsProfanity(string $text): bool
    {
        foreach ($this->badWords as $word) {
            if (preg_match('/\b'.preg_quote($word, '/').'\b/i', $text)) {
                return true;
            }
        }

        return false;
    }
}
