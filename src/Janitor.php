<?php
namespace CookieTime\Janitor;

use App\User;
use CookieTime\Janitor\Contract\Strategy;
use CookieTime\Janitor\Models\Ability;
use CookieTime\Janitor\Models\Role;

class Janitor {

    protected $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * check entity has ability
     *
     * @param $entity User| Role
     * @param Ability $ability String
     * @return bool
     */
    public function may($entity, Ability $ability)
    {
        $permissionsSummary = $entity->permissionsSummary()->getResults();

        if(empty($permissionsSummary))
        {
            return false;
        }

        return $this->strategy->verify($ability->keyCode,$permissionsSummary[$ability->type]);
    }

    /**
     * check user has role
     *
     * @param User $user
     * @param $role
     * @return bool
     */
    public function has(User $user,Role $role)
    {
        $role = $user->roles()->where('name', $role->name)->first();

        if (empty($role)) {
            return false;
        }

        return true;
    }

    /**
     * Attach Role to User
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function attachRole(User $user, Role $role)
    {
        // 添加角色
        // 
        $user->keyCode += $role->keyCode;
        return $user->update()?$user->roles()->attach($role->id):false;
    }

    /**
     * Attach Ability to User Or Role
     * @param $entity User | Role
     * @param Ability $ability
     * @return mixed
     */
    public function attachAbility($entity, Ability $ability)
    {
        // 获取用户 角色权限
        // 解开权限码 去重 然后再相加
        // 更新用户或角色权限
        // 完毕
        $codes = $this->strategy->parseKeyCode($entity->keyCode);

        if (!in_array($ability->keyCode, $codes)) {
            array_push($codes, $ability->keyCode);
        }

        $entity->keyCode = $this->strategy->keyCodeCalculation($codes);

        return $entity->update();
    }


    /**
     * Detach Role to User
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function detachRole(User $user, Role $role)
    {
        // 获取用户权限 及 角色
        // 去除取消的角色之后其它的角色权限取交集
        // 赋予用户权限  取消用户角色
        return $user->roles()->detach($role->id);
    }

    /**
     * Give User Or Role Ability
     *
     * @param $entity
     * @param Ability $ability
     * @return mixed
     */
    public function detachAbility($entity, Ability $ability)
    {
        // 获取用户 角色权限
        // 解开权限码 移除权限 然后再相加
        // 更新用户或角色权限
        // 完毕
        $codes = $this->strategy->parseKeyCode($entity->keyCode);

        if ($key = array_search($ability->keyCode, $codes)) {
            unset($codes[$key]);
        }

        $entity->keyCode = $this->strategy->keyCodeCalculation($codes);

        return $entity->update();
    }

    /**
     * Get Roles of User
     * @param User $user
     * @return mixed
     */
    public function getRoles(User $user)
    {
        return $user->roles()->get()->toArray();
    }

    /**
     * Get Abilities Of User Or Role
     * @param $entity User | Role
     * @return mixed
     */
    public function getAbilities($entity)
    {
        $codes = $this->strategy->parseKeyCode($entity->keyCode);

        return Ability::whereIn('keyCode',$codes)->get()->toArray();
    }
}