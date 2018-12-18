<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;


/**
 * This is the model class for table "fee".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $qualification
 * @property string $institute
 * @property string $address
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $city_id
 * @property integer $mobile
 * @property integer $user_type
 * @property integer $track_id
 * @property integer $journal_id
 * @property integer $no_of_papers
 * @property double $payment
 * @property integer $status
 * @property integer $payment_method
 * @property integer $payment_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthorType $userType
 * @property Journal $journal
 * @property Track $track
 */
class Fee extends \yii\db\ActiveRecord
{
    public $slip;
    public $currency;
    public $payment1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qualification', 'institute', 'user_id', 'payment_method'], 'required'],
            ['user_type', 'required', 'message' => 'Please select one of the given author types.'],
            ['journal_id', 'required', 'message' => 'Please select one of the journals.'],
            [['user_id', 'paper_no', 'user_type', 'track_id', 'journal_id', 'no_of_papers', 'status', 'payment_method', 'created_at', 'updated_at'], 'integer'],
            [['payment1'], 'number'],
            [['payment'], 'safe'],
            [['qualification'], 'string', 'max' => 200],
            [['institute'], 'string', 'max' => 250],
            [['copyright_form', 'file', 'payment_id'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png','jpg','jpeg','gif','xls','csv','pdf','doc','docx','txt']],
            [['copyright_form'], 'file', 'extensions' => ['png','jpg','jpeg','pdf']],
            [['slip'], 'file', 'extensions' => ['png','jpg','jpeg','pdf']],
            [['user_type'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorType::className(), 'targetAttribute' => ['user_type' => 'id']],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::className(), 'targetAttribute' => ['journal_id' => 'id']],
            [['track_id'], 'exist', 'skipOnError' => true, 'targetClass' => Track::className(), 'targetAttribute' => ['track_id' => 'id']],
            [['file', 'copyright_form', 'paper_no'], 'required', 'when' => function ($model) {
                    return ($model->user_type == 1 || $model->user_type == 2);
                }, 'whenClient' => "function (attribute, value) {
                        return ($('#fee-user_type').val() == 1 || $('#fee-user_type').val() == 2);
                    }"],
            [['slip','currency','payment1'], 'required', 'when' => function ($model) {
                    return ($model->payment_method == 1);
                }, 'whenClient' => "function (attribute, value) {
                        return ($('#fee-payment_method').val() == 1);
                    }"],
            ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'qualification' => 'Qualification',
            'institute' => 'Institute',
            'address' => 'Address',
            'file' => 'Paper',
            'copyright_form' => 'Copyright Form',
            'mobile' => 'Mobile Number',
            'user_type' => 'User Type',
            'track_id' => 'Track ID',
            'journal_id' => 'Journal ID',
            'no_of_papers' => 'No of Pages',
            'payment' => 'Payment',
            'currency' => 'Currency Opted',
            'status' => 'Status',
            'payment_method' => 'Payment Method',
            'payment_id' => 'Payment ID',
            'created_at' => 'Date',
            'updated_at' => 'Updated At',
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
    public function getUserType()
    {
        return $this->hasOne(AuthorType::className(), ['id' => 'user_type']);
    }

    public function getUserTypes()
    {
        $countries = AuthorType::find()->where(['status' => 1])->all();
        return ArrayHelper::map($countries,'id','name');
    }
    public function getCurrencies()
    {
        $countries = Currency::find()->where(['status' => 1])->all();
        return ArrayHelper::map($countries,'id','name');
    }
    public function getCurrencyOpted()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['id' => 'journal_id']);
    }
    public function getJournals()
    {
        $journal = Journal::find()->where(['status' => 1])->all();
        return ArrayHelper::map($journal,'id','name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::className(), ['id' => 'track_id']);
    }
    public function getPaymentStatus()
    {
       if($this->status == 0){
           return "Payment incomplete";
       } elseif($this->status == 1){
           return "Payment complete";
       } else {
           return "Payment cancelled";
       }
    }
    public function getSymbolPayment()
    {
       if($this->payment_method == 1){
           return $this->payment;
       } elseif($this->payment_method == 2){
           return "$".$this->payment;
       } else {
           return "Rs.".$this->payment;
       }
    }

    public function getTracks()
    {
        $tracks = Track::find()->where(['status' => 1])->all();
        return ArrayHelper::map($tracks,'id','name');
    }

    public function getPaymentType()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_method']);
    }
    public function getCountries()
    {

        $countries = Countries::find()->where(['status' => 1])->orderBy('name')->all();

        return ArrayHelper::map($countries,'id','name');

    }/* 
    public function getCalculatedPayment()
    {	
		$xtrapay1 = 0;
		$xtrapay2 = 0;
		$xtrapay3 = 0;
		if($this->user_type==1){
			if($this->journal_id == 1){
				$payment1 = 13500;
				$payment2 = 330;
				$payment3 = 7000;
				if($this->no_of_papers-8) {
					$xtrapay1 = ($this->no_of_papers - 8) * 700;
					$xtrapay2 = ($this->no_of_papers - 8) * 15;
					$xtrapay3 = ($this->no_of_papers - 8) * 350;
				}
			} else {
				$payment1 = 9000;
				$payment2 = 150;
				$payment3 = 4500;
				if($this->no_of_papers-8) {
					$xtrapay1 = ($this->no_of_papers - 8) * 200;
					$xtrapay2 = ($this->no_of_papers - 8) * 10;
					$xtrapay3 = ($this->no_of_papers - 8) * 100;
				}
			}

		} elseif($this->user_type==2){
			if($this->journal_id == 1){
				$payment1 = 15500;
				$payment2 = 350;
				$payment3 = 8000;
				if($this->no_of_papers-8) {
					$xtrapay1 = ($this->no_of_papers - 8) * 700;
					$xtrapay2 = ($this->no_of_papers - 8) * 15;
					$xtrapay3 = ($this->no_of_papers - 8) * 350;
				}
			} else {
				$payment1 = 10500;
				$payment2 = 170;
				$payment3 = 5200;
				if($this->no_of_papers-8) {
					$xtrapay1 = ($this->no_of_papers - 8) * 200;
					$xtrapay2 = ($this->no_of_papers - 8) * 10;
					$xtrapay3 = ($this->no_of_papers - 8) * 100;
				}
			}
		} elseif($this->user_type==3) {
			if ($this->journal_id == 1) {
				$payment1 = 5500;
				$payment2 = 90;
				$payment3 = 3000;
			} else {
				$payment1 = 5500;
				$payment2 = 90;
				$payment3 = 3000;
			}
		} else {
			if ($this->journal_id == 1) {
				$payment1 = 6000;
				$payment2 = 120;
				$payment3 = 3200;
			} else {
				$payment1 = 6000;
				$payment2 = 120;
				$payment3 = 3200;
			}
		}		
		
        return "$".($payment2 + $xtrapay2)." / Rs.".($payment1 + $xtrapay1)." / THB.".($payment3 + $xtrapay3);
    } */
    public function getCalculatedPayment()
    {	
		$xtrapay1 = 0;
		$xtrapay2 = 0;
		$xtrapay3 = 0;
		if($this->user_type==1){
			if($this->journal_id == 1){
				$payment1 = 19500;
				$payment2 = 500;
				$payment3 = 10000;
				if($this->no_of_papers-8>0) {
					$xtrapay1 = ($this->no_of_papers - 8) * 700;
					$xtrapay2 = ($this->no_of_papers - 8) * 15;
					$xtrapay3 = ($this->no_of_papers - 8) * 350;
				}
			} else {
				$payment1 = 14000;
				$payment2 = 300;
				$payment3 = 7000;
				if($this->no_of_papers-8>0) {
					$xtrapay1 = ($this->no_of_papers - 8) * 200;
					$xtrapay2 = ($this->no_of_papers - 8) * 10;
					$xtrapay3 = ($this->no_of_papers - 8) * 100;
				}
			}

		} elseif($this->user_type==2){
			if($this->journal_id == 1){
				$payment1 = 21500;
				$payment2 = 550;
				$payment3 = 11000;
				if($this->no_of_papers-8>0) {
					$xtrapay1 = ($this->no_of_papers - 8) * 700;
					$xtrapay2 = ($this->no_of_papers - 8) * 15;
					$xtrapay3 = ($this->no_of_papers - 8) * 350;
				}
			} else {
				$payment1 = 16000;
				$payment2 = 350;
				$payment3 = 8000;
				if($this->no_of_papers-8>0) {
					$xtrapay1 = ($this->no_of_papers - 8) * 200;
					$xtrapay2 = ($this->no_of_papers - 8) * 10;
					$xtrapay3 = ($this->no_of_papers - 8) * 100;
				}
			}
		} elseif($this->user_type==3) {
			if ($this->journal_id == 1) {
				$payment1 = 6500;
				$payment2 = 120;
				$payment3 = 4000;
			} else {
				$payment1 = 6500;
				$payment2 = 120;
				$payment3 = 4000;
			}
		} else {
			if ($this->journal_id == 1) {
				$payment1 = 7500;
				$payment2 = 150;
				$payment3 = 4500;
			} else {
				$payment1 = 7500;
				$payment2 = 150;
				$payment3 = 4500;
			}
		}		
		
        return "$".($payment2 + $xtrapay2)." / Rs.".($payment1 + $xtrapay1)." / THB.".($payment3 + $xtrapay3);
    }
    public function PaymentAmount($id)
    {
        $xtrapay1 = 0;
        $xtrapay2 = 0;
        if($this->user_type==1){
            if($this->journal_id == 1){
                $payment1 = 19500;
                $payment2 = 500;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 700;
                    $xtrapay2 = ($this->no_of_papers - 8) * 15;
                }
            } else {
                $payment1 = 14000;
                $payment2 = 300;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 200;
                    $xtrapay2 = ($this->no_of_papers - 8) * 10;
                }
            }

        } elseif($this->user_type==2){
            if($this->journal_id == 1){
                $payment1 = 21500;
                $payment2 = 550;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 700;
                    $xtrapay2 = ($this->no_of_papers - 8) * 15;
                }
            } else {
                $payment1 = 16000;
                $payment2 = 350;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 200;
                    $xtrapay2 = ($this->no_of_papers - 8) * 10;
                }
            }
        } elseif($this->user_type==3) {
            if ($this->journal_id == 1) {
                $payment1 = 6500;
                $payment2 = 120;
            } else {
                $payment1 = 6500;
                $payment2 = 120;
            }
        } else {
            if ($this->journal_id == 1) {
                $payment1 = 7500;
                $payment2 = 150;
            } else {
                $payment1 = 7500;
                $payment2 = 150;
            }
        }
        if($id == 1){
            return $payment1 + $xtrapay1;
        } elseif($id == 2){
            return $payment2 + $xtrapay2;
        } else {
            return $payment1 + $xtrapay1;
        }

    }
    public function getFinalAmount()
    {
        $xtrapay1 = 0;
        $xtrapay2 = 0;
        $xtrapay3 = 0;
        if($this->user_type==1){
            if($this->journal_id == 1){
                $payment1 = 19500;
				$payment2 = 500;
				$payment3 = 10000;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 700;
                    $xtrapay2 = ($this->no_of_papers - 8) * 15;
                    $xtrapay3 = ($this->no_of_papers - 8) * 350;
                }
            } else {
                $payment1 = 14000;
				$payment2 = 300;
				$payment3 = 7000;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 200;
                    $xtrapay2 = ($this->no_of_papers - 8) * 10;
                    $xtrapay3 = ($this->no_of_papers - 8) * 100;
                }
            }

        } elseif($this->user_type==2){
            if($this->journal_id == 1){
                $payment1 = 21500;
				$payment2 = 550;
				$payment3 = 11000;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 700;
                    $xtrapay2 = ($this->no_of_papers - 8) * 15;
                    $xtrapay3 = ($this->no_of_papers - 8) * 350;
                }
            } else {
                $payment1 = 16000;
				$payment2 = 350;
				$payment3 = 8000;
                if($this->no_of_papers-8>0) {
                    $xtrapay1 = ($this->no_of_papers - 8) * 200;
                    $xtrapay2 = ($this->no_of_papers - 8) * 10;
                    $xtrapay3 = ($this->no_of_papers - 8) * 100;
                }
            }
        } elseif($this->user_type==3) {
            if ($this->journal_id == 1) {
                $payment1 = 6500;
				$payment2 = 120;
				$payment3 = 4000;
            } else {
                $payment1 = 6500;
				$payment2 = 120;
				$payment3 = 4000;
            }
        } else {
            if ($this->journal_id == 1) {
                $payment1 = 7500;
				$payment2 = 150;
				$payment3 = 4500;
            } else {
                $payment1 = 7500;
				$payment2 = 150;
				$payment3 = 4500;
            }
			
        }
        if($this->payment_method == 3){
            return $payment1 + $xtrapay1;
        } elseif($this->payment_method == 2){
            return $payment2 + $xtrapay2;
        } else {
            return $payment1 + $xtrapay1;
        }

    }
	public function getPayMethod()
	{
		if ($this->status == 0) {
            return "-";
        } else{
			return $this->paymentType->name;
		}
	}
    public function getPaymentDetails()
    {
        if ($this->status == 1) {
            return $this->payment;
        } elseif($this->status == 0) {
            return Html::a(Yii::t('app', 'Pay Now'), ['update-fee', 'fee_id' => $this->id], [
                'class' => 'btn btn-danger',
                'style' => 'color:#fff',
            ]);
        } else {
            return "Payment cancelled";
        }
    }
	
    /**
     * @inheritdoc
     * @return FeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeeQuery(get_called_class());
    }
	public function sendMail($email,$subject,$body)
    {

        $send =  Yii::$app->mailer->compose(['html' => '@common/mail/views/accountcreation'], ['message'=>$body])
            ->setTo(Yii::$app->user->identity->email)
            ->setFrom($email)
            ->setSubject($subject)
            ->send();

    }
}
