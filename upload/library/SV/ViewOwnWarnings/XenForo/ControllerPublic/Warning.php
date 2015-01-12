<?php

class SV_ViewOwnWarnings_XenForo_ControllerPublic_Warning extends XFCP_SV_ViewOwnWarnings_XenForo_ControllerPublic_Warning
{
    protected function _getUserModel()
    {
        return $this->getModelFromCache('XenForo_Model_User');
    }

    public function actionIndex()
    {
        $warningId = $this->_input->filterSingle('warning_id', XenForo_Input::UINT);
        $warning = $this->_getWarningOrError($warningId);

        $canViewWarningDetails = $this->_getUserModel()->canViewWarnings();
        $visitor = XenForo_Visitor::getInstance();
        if ($warning['user_id'] == $visitor['user_id'])
        {
            SV_ViewOwnWarnings_XenForo_Model_User::$warning_user_id = $warning['user_id'];
        }

        $ret = parent::actionIndex();

        unset(SV_ViewOwnWarnings_XenForo_Model_User::$warning_user_id);

        return $ret;
    }
}
