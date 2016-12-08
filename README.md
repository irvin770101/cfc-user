# ksd-member

### Configuration
add in `confg/app.php`
```
'providers' => [
    KSD\Member\Providers\MemberServiceProvider::class,
]
```

#### Aliases
```
'aliases' => [
    'Member' => KSD\Member\Facades\Member::class,
]
```
