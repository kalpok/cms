<?php
namespace modules\setting\models;

use Yii;
use yii\base\Model;

class Setting extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            ['key', 'string', 'max' => 255],
            ['value', 'string', 'max' => 1023]
        ];
    }

    public static function tableName()
    {
        return 'setting';
    }

    public function getLabel()
    {
        $items=[
            'website.timezone' => 'ناحیه زمانی',
            'website.cache' => 'کش سیستم',
            'website.deactiveUser' => 'غیر فعال کردن کاربر در صورت اشتباه وارد نمودن اطلاعات کاربری',
            'website.failedLoginAttempts' => 'تعداد دفعات مجاز اشتباه زدن اطلاعات کاربری',
            'website.googleAnalytics' => 'کد گوگل آنالیتیکز',
            'website.maintenanceMode' => 'وضعیت سایت',
            'email.senderEmail' => 'آدرس ایمیل فرستنده',
            'email.senderName' => 'نام فرستنده',
            'email.protocol' => 'نوع ایمیل',
            'email.smtpServer' => 'سرور ایمیل',
            'email.smtpUsername' => 'نام کاربری',
            'email.smtpPassword' => 'کلمه عبور',
            'email.smtpPort' => 'پورت',
        ];
        return $items[$this->key];
    }
}
