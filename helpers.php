<?php

if (!function_exists('coin')) {
    /**
     * 金币变动
     * @param int $user_id
     * @param string $action
     * @param int $coins 金币数量 正数+ 负数-
     * @param int $modelId 源ID
     * @param null $modelSubject 源标题
     * @return bool
     * @throws \yii\db\Exception
     */
    function coin($user_id, $action, $coins = 0, $modelId = 0, $modelSubject = null)
    {
        $extend = \yuncms\user\models\Extend::findOne($user_id);
        if ($extend) {
            $transaction = \yuncms\user\models\Extend::getDb()->beginTransaction();
            try {
                $value = $extend->coins + $coins;
                if ($coins < 0 && $value < 0) {
                    return false;
                }
                //更新用户钱包
                $extend->updateAttributes(['coins' => $value]);
                /*记录详情数据*/
                \yuncms\coin\models\Coin::create([
                    'user_id' => $user_id,
                    'action' => $action,
                    'model_id' => $modelId,
                    'model_subject' => $modelSubject,
                    'coins' => $coins,
                ]);
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }
}
 