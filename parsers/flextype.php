<?php

mkdir('FLEXTYPE');

$locales = ['Afrikaans', 'Bengali', 'English', 'Gujarati', 'Hindi', 'Indonesian', 'Kannada', 'Malayalam', 'Nepali', 'Oriya', 'Punjabi', 'Sepedi', 'Tamil', 'Telugu', 'Xhosa', 'Zulu'];

$book_names = ["Genesis", "Exodus", "Leviticus", "Numbers", "Deuteronomy", "Joshua",
"Judges", "Ruth", "1 Samuel", "2 Samuel", "1 Kings", "2 Kings", "1 Chronicles",
"2 Chronicles", "Ezra", "Nehemiah", "Esther", "Job", "Psalms", "Proverbs", "Ecclesiastes",
"Song of Solomon", "Isaiah", "Jeremiah", "Lamentations", "Ezekiel", "Daniel",
"Hosea", "Joel", "Amos", "Obadiah", "Jonah", "Micah", "Nahum", "Habakkuk", "Zephaniah",
"Haggai", "Zechariah", "Malachi", "Matthew", "Mark", "Luke", "John", "Acts", "Romans",
"1 Corinthians", "2 Corinthians", "Galatians", "Ephesians", "Philippians", "Colossians",
"1 Thessalonians", "2 Thessalonians", "1 Timothy", "2 Timothy", "Titus", "Philemon",
"Hebrews", "James", "1 Peter", "2 Peter", "1 John", "2 John", "3 John", "Jude", "Revelation"];

$page_total = 0;

foreach ($locales as $locale) {

    $page = 0;
    $i = 0;
    $c = 0;
    $v = 0;

    $filecontent = file_get_contents("{$locale}/bible.json");
    $books = json_decode($filecontent);


    mkdir('FLEXTYPE/' . Text::safeString($locale));
    $data = "---\ntitle: {$locale}\ntemplate: locale\n---\n";
    file_put_contents('FLEXTYPE/'.  Text::safeString($locale) . '/entry.md', $data);


    foreach ($books->Book as $book) {

        echo $i . $book_names[$i] . "\n";

        mkdir('FLEXTYPE/'.Text::safeString($locale) . '/'.  Text::safeString($book_names[$i]));
        $data = "---\ntitle: ". $book_names[$i] ."\ntemplate: book\n---\n";
        file_put_contents('FLEXTYPE/'.Text::safeString($locale) .'/'.  Text::safeString($book_names[$i]) . '/entry.md', $data);

        $page++;
        $page_total++;
        $i++;
        $c = 0;

        foreach ($book->Chapter as $chapter) {

            mkdir('FLEXTYPE/'.Text::safeString($locale).'/'.Text::safeString($book_names[$i]).'/'.  $c);
            $data = "---\ntitle: Chapter {$c}\ntemplate: chapter\n---\n";
            file_put_contents('FLEXTYPE/'.Text::safeString($locale).'/' . Text::safeString($book_names[$i]) . '/'.  $c . '/entry.md', $data);

            $page++;
            $page_total++;
            $c++;
            $v = 0;

            foreach ($chapter->Verse as $verse) {

                $page++;
                $page_total++;
                $v++;

                mkdir('FLEXTYPE/'.Text::safeString($locale).'/'.Text::safeString($book_names[$i]).'/'.  $c  .'/' . $v);

                $data = "---\ntitle: Verse {$v}\ntemplate: verse\n---\n{$verse->Verse}";
                file_put_contents('FLEXTYPE/'.Text::safeString($locale).'/'.Text::safeString($book_names[$i]).'/'.  $c  .'/' . $v . '/entry.md', $data);



            }
        }

    }

echo "\n\n\n\n======================== \n\nPages: ". $page . "\n\n========================\n\n\n\n";

}

echo "\n\n\n\n======================== \n\nPages Total: ". $page_total . "\n\n========================\n\n\n\n";
