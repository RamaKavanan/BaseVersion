<?php
    /*********************************************************************************
     * Zurmo is a customer relationship management program developed by
     * Zurmo, Inc. Copyright (C) 2015 Zurmo Inc.
     *
     * Zurmo is free software; you can redistribute it and/or modify it under
     * the terms of the GNU Affero General Public License version 3 as published by the
     * Free Software Foundation with the addition of the following permission added
     * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
     * IN WHICH THE COPYRIGHT IS OWNED BY ZURMO, ZURMO DISCLAIMS THE WARRANTY
     * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
     *
     * Zurmo is distributed in the hope that it will be useful, but WITHOUT
     * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
     * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
     * details.
     *
     * You should have received a copy of the GNU Affero General Public License along with
     * this program; if not, see http://www.gnu.org/licenses or write to the Free
     * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
     * 02110-1301 USA.
     *
     * You can contact Zurmo, Inc. with a mailing address at 27 North Wacker Drive
     * Suite 370 Chicago, IL 60606. or at email address contact@zurmo.com.
     *
     * The interactive user interfaces in original and modified versions
     * of this program must display Appropriate Legal Notices, as required under
     * Section 5 of the GNU Affero General Public License version 3.
     *
     * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
     * these Appropriate Legal Notices must retain the display of the Zurmo
     * logo and Zurmo copyright notice. If the display of the logo is not reasonably
     * feasible for technical reasons, the Appropriate Legal Notices must display the words
     * "Copyright Zurmo Inc. 2015. All rights reserved".
     ********************************************************************************/

    class CostbookSearch
    {
        /**
         * For a given email address, run search by email address and retrieve costbook models.
         * @param String $emailAddress
         * @param null | int $pageSize
          */
        public static function getCostbooksByAnyEmailAddress($emailAddress, $pageSize = null)
        {
            assert('is_string($emailAddress)');
            $metadata = array();
            $metadata['clauses'] = array(
                1 => array(
                    'attributeName'        => 'primaryEmail',
                    'relatedAttributeName' => 'emailAddress',
                    'operatorType'         => 'equals',
                    'value'                => $emailAddress,
                ),
                2 => array(
                    'attributeName'        => 'secondaryEmail',
                    'relatedAttributeName' => 'emailAddress',
                    'operatorType'         => 'equals',
                    'value'                => $emailAddress,
                ),
            );
            $metadata['structure'] = '(1 or 2)';
            $joinTablesAdapter   = new RedBeanModelJoinTablesQueryAdapter('Costbook');
            $where  = RedBeanModelDataProvider::makeWhere('Costbook', $metadata, $joinTablesAdapter);
            return Costbook::getSubset($joinTablesAdapter, null, $pageSize, $where);
        }

        /**
         * For a given phone number, run search by phone numbers and retrieve costbook models.
         * @param string $phoneNumber
         * @param null|int $pageSize
         */
        public static function getCostbooksByAnyPhone($phoneNumber, $pageSize = null)
        {
            assert('is_string($phoneNumber)');
            $metadata = array();
            $metadata['clauses'] = array(
                1 => array(
                    'attributeName'        => 'officePhone',
                    'operatorType'         => 'equals',
                    'value'                => $phoneNumber,
                ),
            );
            $metadata['structure'] = '1';
            $joinTablesAdapter   = new RedBeanModelJoinTablesQueryAdapter('Costbook');
            $where  = RedBeanModelDataProvider::makeWhere('Costbook', $metadata, $joinTablesAdapter);
            return Costbook::getSubset($joinTablesAdapter, null, $pageSize, $where);
        }

        /**
         * For a given partialName, run search by partial name and retrieve costbook models.
         * @param string $partialName
         * @param null|int $pageSize
         */
        public static function getCostbooksByPartialName($partialName, $pageSize = null)
        {
            assert('is_string($partialName)');
            $metadata = array();
            $metadata['clauses'] = array(
                1 => array(
                    'attributeName'        => 'name',
                    'operatorType'         => 'contains',
                    'value'                => $partialName,
                ),
            );
            $metadata['structure'] = '1';
            $joinTablesAdapter   = new RedBeanModelJoinTablesQueryAdapter('Costbook');
            $where  = RedBeanModelDataProvider::makeWhere('Costbook', $metadata, $joinTablesAdapter);
            return Costbook::getSubset($joinTablesAdapter, null, $pageSize, $where);
        }
    }
?>