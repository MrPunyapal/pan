<?php

use Pan\PanConfiguration;

it('have a max of 50 analytics by default', function (): void {
    expect(PanConfiguration::instance()->toArray())->toBe([
        'max_analytics' => 50,
        'allowed_analytics' => [],
    ]);
});

it('can set the max number of analytics to store', function (): void {
    PanConfiguration::maxAnalytics(100);

    expect(PanConfiguration::instance()->toArray())->toBe([
        'max_analytics' => 100,
        'allowed_analytics' => [],
    ]);
});

it('can set the max number of analytics to unlimited', function (): void {
    PanConfiguration::unlimitedAnalytics();

    expect(PanConfiguration::instance()->toArray())->toBe([
        'max_analytics' => PHP_INT_MAX,
        'allowed_analytics' => [],
    ]);
});

it('can set the allowed analytics names to store', function (): void {
    PanConfiguration::allowedAnalytics(['help-modal', 'contact-modal']);

    expect(PanConfiguration::instance()->toArray())->toBe([
        'max_analytics' => 50,
        'allowed_analytics' => ['help-modal', 'contact-modal'],
    ]);
});

it('sets an empty array of allowed analytics names by default', function (): void {
    expect(PanConfiguration::instance()->toArray())->toBe([
        'max_analytics' => 50,
        'allowed_analytics' => [],
    ]);
});

it('may reset the configuration to its default values', function (): void {
    PanConfiguration::maxAnalytics(99);
    PanConfiguration::allowedAnalytics(['help-modal', 'contact-modal']);

    expect(PanConfiguration::instance()->toArray())->toBe([
        'max_analytics' => 99,
        'allowed_analytics' => ['help-modal', 'contact-modal'],
    ]);

    PanConfiguration::reset();

    expect(PanConfiguration::instance()->toArray())->toBe([
        'max_analytics' => 50,
        'allowed_analytics' => [],
    ]);
});
