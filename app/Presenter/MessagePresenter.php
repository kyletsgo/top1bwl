<?php
namespace App\Presenter;

class MessagePresenter
{
    /**
     * 取得必填
     *
     * @param string $columnName
     * @param string $type
     * @return string
     */
    public static function getRequired($columnName = null, $type = 'text')
    {
        switch($type)
        {
            case 'text':
                $action = '請輸入';
                break;
            case 'option':
                $action = '請選擇';
                break;
            case 'ckeckbox':
                $action = '請勾選';
                break;
            case 'file':
                $action = '請上傳';
                break;
            default:
                $action = '請輸入';
                break;
        }

        return $action . $columnName;
    }

    /**
     * 取得最多
     *
     * @param string $columnName
     * @param integer $length
     * @return string
     */
    public static function getMax($columnName = null, $length = null)
    {
        return $columnName . '最多' . $length . '字';
    }

    /**
     * 取得最少
     *
     * @param string $columnName
     * @param integer $length
     * @return string
     */
    public static function getMin($columnName = null, $length = null)
    {
        return $columnName . '最少' . $length . '字';
    }

    /**
     * 取得數字
     *
     * @param string $columnName
     * @return string
     */
    public static function getInteger($columnName = null)
    {
        return $columnName . '必須是數字';
    }

    /**
     * 判斷唯一
     *
     * @param string $columnName
     * @return string
     */
    public static function getUnique($columnName = null)
    {
        return $columnName . '已重複';
    }

    /**
     * 取得圖片
     *
     * @param string $columnName
     * @return string
     */
    public static function getImage($columnName = null)
    {
        return $columnName . '必須是圖片';
    }

    /**
     * 取得MIME
     *
     * @param string $columnName
     * @param string $fileType
     * @return string
     */
    public static function getMimes($columnName = null, $fileType = null)
    {
        return $columnName . '格式必須是' . $fileType;
    }

    /**
     * 取得日期
     *
     * @param string $columnName
     * @return string
     */
    public static function getDate($columnName = null)
    {
        return $columnName . '必須是日期格式';
    }

    /**
     * 取得驗證訊息(取消使用)
     *
     * @param [type] $key
     * @param [type] $length
     * @return void
     */
    public static function getValidatorMessage($key = null, $length = null)
    {
        $messages = [
            'area.required' => '請選擇區域',
            'area.max' => '區域最多' . $length . '字',
            'name.required' => '請輸入姓名',
            'name.max' => '姓名最多' . $length . '字',
            'email.required' => '請輸入Email',
            'email.email' => 'Email格式錯誤',
            'email.unique' => '此Email已註冊',
            'email.max' => 'Email最多' . $length . '字',
            'password.required' => '請輸入密碼',
            'mobile.max' => '連絡方式最多' . $length . '字',
            'tel.max' => '連絡電話最多' . $length . '字',
            'fax.max' => '傳真最多' . $length . '字',
            'address.max' => '連絡地址最多' . $length . '字',
            'icon.required' => '請選擇圖示',
            // Version
            'version.required' => '請輸入版本',
            'version.max' => '版本最多' . $length . '字',
            'url.required' => '請輸入URL',
            'url.max' => 'url最多' . $length . '字',
            'message.max' => '訊息最多' . $length . '字',
            //Banner
            'title.required' => '請輸入標題',
            'title.max' => '標題最多' . $length . '字',
            'banner.required' => '請上傳圖片',
            'banner.image' => '圖片格式僅限jpeg, png, bmp, gif 或 svg'

        ];

        return $messages[$key];
    }
}