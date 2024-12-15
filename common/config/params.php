<?php
return [
    'adminEmail' => 'admin@americor.local',
    'supportEmail' => 'support@americor.local',
    'senderEmail' => 'noreply@americor.local',
    'senderName' => 'americor.local mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'loanService' => [
        'minAge' => 18,
        'maxAge' => 60,
        'minFicoCreditScore' => 500,
        'minIncome' => 1000,
        'allowedStates' => ['CA', 'NY', 'NV'],
    ]
];
