<?php

namespace Hindbiswas\QueBee\Query;

interface QueryStruct {
    public function build(): string;
}