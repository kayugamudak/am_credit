<?php

return [
    [
        'id' => 10,
        'first_name' => 'Bob',
        'last_name' => 'Dylan',
        'age' => 18,
        'income' => 800, //rejected by income
        'state_code' => 'CA',
        'ssn' => 123456789,
        'fico_credit_score' => 500,
        'city' => 'California',
        'address' => 'Washington ave, 11',
        'zip' => 55213,
        'email' => 'bob.dylan@gmail.com',
        'phone' => '+636340134123',
    ],

    [
        'id' => 11,
        'first_name' => 'Kurt',
        'last_name' => 'Cobain',
        'age' => 27,
        'income' => 2000,
        'state_code' => 'NV',
        'ssn' => 123456780,
        'fico_credit_score' => 400, //rejected by credit score
        'city' => 'Nevada',
        'address' => 'Any ave, 1',
        'zip' => 55314,
        'email' => 'kurt.cobain@gmail.com',
        'phone' => '+636320131123',
    ],

    [
        'id' => 12,
        'first_name' => 'Brad',
        'last_name' => 'Pitt',
        'age' => 60,
        'income' => 1000000,
        'state_code' => 'WA', //rejected by state
        'ssn' => 123436782,
        'fico_credit_score' => 600,
        'city' => 'Washington',
        'address' => 'Some ave, 13',
        'zip' => 55314,
        'email' => 'brad.pitt@gmail.com',
        'phone' => '+636220131523',
    ],

    [
        'id' => 13,
        'first_name' => 'Justin',
        'last_name' => 'Bieber',
        'age' => 17, //rejected by age
        'income' => 3000,
        'state_code' => 'CA',
        'ssn' => 123556789,
        'fico_credit_score' => 500,
        'city' => 'California',
        'address' => 'Washington ave, 15',
        'zip' => 55213,
        'email' => 'just.beaver@gmail.com',
        'phone' => '+636349132123',
    ],

    [
        'id' => 14,
        'first_name' => 'Donald',
        'last_name' => 'Trump',
        'age' => 60,
        'income' => 100000000,
        'state_code' => 'CA',
        'ssn' => 123236782,
        'fico_credit_score' => 800,
        'city' => 'California', //accepted, increased percentage rate by state
        'address' => 'All ave, 13',
        'zip' => 55213,
        'email' => 'trump@gmail.com',
        'phone' => '+636120131523',
    ],

    [
        'id' => 15, //accepted with normal rate
        'first_name' => 'Matt',
        'last_name' => 'Damon',
        'age' => 55,
        'income' => 300000,
        'state_code' => 'NV',
        'ssn' => 123452789,
        'fico_credit_score' => 5600,
        'city' => 'Nevada',
        'address' => 'Best ave, 115',
        'zip' => 55223,
        'email' => 'matt@gmail.com',
        'phone' => '+636319132123',
    ],
];