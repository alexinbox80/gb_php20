<?php
class Model {
    function text_get(): string
    {
        return file_get_contents('data/text_txt');
    }

    function text_set(string $text)
    {
        return file_put_contents('data/text_txt', $text);
    }
}

