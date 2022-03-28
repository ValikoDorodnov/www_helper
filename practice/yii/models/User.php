<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * @property string $id [integer]
 * @property string $username [varchar(255)]
 * @property string $auth_key [varchar(32)]
 * @property string $password_hash [varchar(255)]
 * @property string $email [varchar(255)]
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return 'user';
    }

    public static function findIdentity($id): User|IdentityInterface|null
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['username' => $username]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword(string $password): void
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }
}
