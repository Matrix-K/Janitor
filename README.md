# Janitor

基于位与、质数计算实现的权限系统

### 优缺点

* 优点 计算速度快
* 缺点 位与运算仅支持63个权限  质数运算支持最多131个权限 (64位系统下)

### 安装

    composer require cookietime/janitor

### 配置

* 添加 `\CookieTime\Janitor\JanitorServiceProvider::class` 到 `config/app.php`
* `php artisan vendor:publish`
* `php artisan migrate`

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