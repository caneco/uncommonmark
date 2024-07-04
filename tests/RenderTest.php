<?php

use Caneco\Uncommonmark\Uncommonmark;

it('can convert a <strong> string')
    ->expect(trim(Uncommonmark::convert('**string**')))
    ->toBe('<p><strong>string</strong></p>');

it('can convert a <b> string')
    ->expect(trim(Uncommonmark::convert('*string*')))
    ->toBe('<p><b>string</b></p>');

it('can convert a <em> string')
    ->expect(trim(Uncommonmark::convert('__string__')))
    ->toBe('<p><em>string</em></p>');

it('can convert a <i> string')
    ->expect(trim(Uncommonmark::convert('_string_')))
    ->toBe('<p><i>string</i></p>');

it('can convert a <mark> string')
    ->expect(trim(Uncommonmark::convert('==string==')))
    ->toBe('<p><mark>string</mark></p>');
