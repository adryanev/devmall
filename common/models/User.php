<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $access_token
 * @property string $nomor_hp
 * @property string $email
 * @property int $status
 * @property int $has_booth
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 * @property string $sms_verification
 * @property int $is_phone_verified
 *
 * @property Booth $booth
 * @property Favorit[] $favorits
 * @property ProfilUser $profilUser
 * @property Follow[] $follows
 * @property Ulasan[] $ulasans
 * @property VerifikasiUser $verifikasiUser
 * @property Keranjang[] $keranjangs

 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_VERIFIED = 3;
    const STATUS_BANNED = 5;

    const HAS_BOOTH = 1;
    const STATUS_PHONE_VERIFIED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id,]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['status'=>User::STATUS_ACTIVE])->orWhere(['status'=>USER::STATUS_VERIFIED])->andWhere(['username'=>$username])->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
        ]);
    }

    public function getHasBooth()
    {
        return $this->has_booth === self::HAS_BOOTH;
    }

    public function getStatus()
    {
        $status = [
            self::STATUS_ACTIVE => 'Aktif',
            self::STATUS_INACTIVE => 'Tidak Aktif',
            self::STATUS_VERIFIED => 'Terverifikasi',
            self::STATUS_BANNED => 'Banned'
        ];

        return $status[$this->status];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'has_booth', 'is_phone_verified'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'access_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['nomor_hp'], 'string', 'max' => 20],
            [['sms_verification'], 'string', 'max' => 6],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'access_token' => 'Access Token',
            'nomor_hp' => 'Nomor Hp',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'has_booth' => 'Punya Booth',
            'sms_verification' => 'Kode Verifikasi SMS'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooth()
    {
        return $this->hasOne(Booth::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorits()
    {
        return $this->hasMany(Favorit::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfilUser()
    {
        return $this->hasOne(ProfilUser::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUlasans()
    {
        return $this->hasMany(Ulasan::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVerifikasiUser()
    {
        return $this->hasOne(VerifikasiUser::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeranjangs()
    {
        return $this->hasMany(Produk::className(), ['id'=>'id_produk'])->viaTable(Keranjang::tableName(),['id_user'=>'id']);
    }

    public function getKeranjang(){
        return $this->hasMany(Keranjang::className(),['id_user'=>'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateSmsVerification()
    {
        $number = rand(100000, 999999);
        $this->sms_verification = $number;
    }


    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function following($id)
    {
        return $this->getFollows()->andWhere(['id_booth' => $id])->one();

    }

    /**
     * @return ActiveQuery
     */

    public function getFollows()
    {
        return $this->hasMany(Follow::class, ['id_pengguna' => 'id']);
    }
    public function isFavoriting($id){
        $result = $this->getFavorits()->andWhere(['id_produk'=>$id])->one();
        return empty($result)? false: true;
    }

}
