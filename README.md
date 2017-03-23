# Janitor

基于位与计算实现的权限系统

### 安装

    composer require cookietime/janitor

### 配置

1. 添加 `\CookieTime\Janitor\JanitorServiceProvider::class` 到 `config/app.php`
2. `php artisan vendor:publish`
3. `php artisan migrate`


### 使用方法

```php

// User Role Ability 均为实体类
// 是否具有角色
Janitor::has(User,Role);
// 是否有权限
Janitor::may(User,Ability);
Janitor::may(Role,Ability);
// 赋予角色
Janitor::attachRole(User,Role);
// 取消角色授予
Janitor::detachRole(User,Role);
// 赋予权限
Janitor::attachAbility(User,Ability);
Janitor::attachAbility(Role,Ability);
// 取消授权
Janitor::detachAbility(User,Ability);
Janitor::detachAbility(Role,Ability);
```