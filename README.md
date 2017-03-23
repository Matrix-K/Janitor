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
$user = User::find($id);
$role = Role::find($id);
$ability = Ability::find($id);

// 是否具有角色
Janitor::has($user,$role);
// 是否有权限
Janitor::may($user,$ability);
Janitor::may($role,$ability);
// 赋予角色
Janitor::attachRole($user,$role);
// 取消角色授予
Janitor::detachRole($user,$role);
// 赋予权限
Janitor::attachAbility($user,$ability);
Janitor::attachAbility($role,$ability);
// 取消授权
Janitor::detachAbility($user,$ability);
Janitor::detachAbility($role,$ability);
```