<?php declare(strict_types=1);

it('create the middleware correctly', function (): void {
    $this->artisan('somake:middleware')
        ->expectsQuestion('What is the Middleware name ?', 'FilterUnpublished')
        ->expectsQuestion('Do you want it to be in an Application ? Say no if you want it in Support', true)
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Website/Blog')
        ->expectsQuestion(
            'You may want FilterUnpublished to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsOutput('The App\\Website\\Blog\\Middleware\\FilterUnpublished class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Website\\Blog\\Middleware\\FilterUnpublished ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Website/Blog/Middleware/FilterUnpublished.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('allows the middleware to be created in a sub namespace', function (): void {
    $this->artisan('somake:middleware')
        ->expectsQuestion('What is the Middleware name ?', 'OnlySuperAdmin')
        ->expectsQuestion('Do you want it to be in an Application ? Say no if you want it in Support', true)
        ->expectsOutput('I detected 3 applications.')
        ->expectsTable(['Applications'], [['Admin'], ['Website/Blog'], ['Website/Videos']])
        ->expectsQuestion('What is the Application ?', 'Admin')
        ->expectsQuestion(
            'You may want OnlySuperAdmin to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            'Auth'
        )
        ->expectsOutput('The App\\Admin\\Middleware\\Auth\\OnlySuperAdmin class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for App\\Admin\\Middleware\\Auth\\OnlySuperAdmin ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/App/Admin/Middleware/Auth/OnlySuperAdmin.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('create the middleware correctly in support', function (): void {
    $this->artisan('somake:middleware')
        ->expectsQuestion('What is the Middleware name ?', 'FilterUnpublished')
        ->expectsQuestion('Do you want it to be in an Application ? Say no if you want it in Support', false)
        ->expectsQuestion(
            'You may want FilterUnpublished to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            null
        )
        ->expectsOutput('The Support\\Http\\Middleware\\FilterUnpublished class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Support\\Http\\Middleware\\FilterUnpublished ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Support/Http/Middleware/FilterUnpublished.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});

it('allows the middleware to be created in a sub namespace of support', function (): void {
    $this->artisan('somake:middleware')
        ->expectsQuestion('What is the Middleware name ?', 'OnlySuperAdmin')
        ->expectsQuestion('Do you want it to be in an Application ? Say no if you want it in Support', false)
        ->expectsQuestion(
            'You may want OnlySuperAdmin to live in a sub namespace. Which one ? Leave it empty if you want to leave it in root namespace.',
            'Auth'
        )
        ->expectsOutput('The Support\\Http\\Middleware\\Auth\\OnlySuperAdmin class was successfully created !')
        ->expectsQuestion('Do you want to create a Unit Test for Support\\Http\\Middleware\\Auth\\OnlySuperAdmin ?', false)
        ->assertExitCode(0)
        ->execute();

    expect($this->app->basePath('app/Support/Http/Middleware/Auth/OnlySuperAdmin.php'))
        ->toBeFile()
        ->toMatchFileSnapshot();
});
