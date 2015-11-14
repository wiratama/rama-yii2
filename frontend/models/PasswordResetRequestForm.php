<?php
namespace frontend\models;

use frontend\models\Member;
use yii\base\Model;

class PasswordResetRequestForm extends Model
{
	public $email;

	public function rules()
	{
		return [
			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'exist',
				'targetClass' => '\frontend\models\Member',
				'filter' => ['status' => Member::STATUS_ACTIVE],
				'message' => 'There is no user with such email.'
			],
		];
	}

	public function sendEmail()
	{
		/* @var $member Member */
		$member = Member::findOne([
			'status' => Member::STATUS_ACTIVE,
			'email' => $this->email,
		]);

		if ($member) {
			if (!Member::isPasswordResetTokenValid($member->password_reset_token)) {
				$member->generatePasswordResetToken();
			}

			if ($member->save(false)) { // $member->save(false)=>skip all validation rules
				return \Yii::$app->phpmailer->compose('passwordResetToken-html', 
						[
							'user' => $member,
							'htmlLayout' => 'layouts/html'
						])
						->setTo($this->email)
						->setSubject('Password reset for ' . \Yii::$app->name)
						->send();
			}
		}

		return false;
	}
}
