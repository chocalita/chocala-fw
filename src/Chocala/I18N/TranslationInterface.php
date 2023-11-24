<?php

namespace Chocala\I18N;

interface TranslationInterface
{

    public function loadLangMessages(string $lang);

    public function translate(string $key, array $args): string;

}