<?php

namespace deefyprojet\render;

interface Renderer{

    const COMPACT = "cpt";
    const LONG = "long";

    public function render(string $type) : string;

}