// vim: ts=4:sw=4:nu:fdc=2:nospell
/*global Ext */
/**
 * @class Ext.ux.form.XCheckbox
 * @extends Ext.form.Checkbox
 *
 * A nicer checkbox always submitting configurable values
 *
 * @author    Ing. Jozef SakÃ¡loÅ¡
 * @copyright (c) 2008, Ing. Jozef SakÃ¡loÅ¡
 * @version   2.0
 * @date      10. February 2008
 * @revision  $Id: Ext.ux.form.XCheckbox.js 589 2009-02-21 23:30:18Z jozo $
 *
 * @license Ext.ux.form.XCheckbox is licensed under the terms of
 * the Open Source LGPL 3.0 license.  Commercial use is permitted to the extent
 * that the code/component(s) do NOT become part of another Open Source or Commercially
 * licensed development library or toolkit without explicit permission.
 * 
 * 

License details: http://www.gnu.org/licenses/lgpl.html

 *
 * @forum     25924
 *
 * @donate
 * 

 *
 *
 *
 *
 *

 */

Ext.ns('Ext.ux.form');

/**
 * Creates new XCheckbox
 * @constructor
 * @param {Object} config A config object
 */
Ext.ux.form.XCheckbox = Ext.extend(Ext.form.Checkbox, {
        
/**
         * @cfg {String} submitOffValue Value submitted if checkbox is unchecked (defaults to "false")
         */
         submitOffValue:'false'

        
/**
         * @cfg {String} submitOnValue Value submitted if checkbox is checked (defaults to "true")
         */
        ,submitOnValue:'true'

        ,onRender:function() {

                this.inputValue = this.submitOnValue;

                // call parent
                Ext.ux.form.XCheckbox.superclass.onRender.apply(this, arguments);

                // create hidden field that is submitted if checkbox is not checked
                this.hiddenField = this.wrap.insertFirst({tag:'input', type:'hidden'});

                // support tooltip
                if(this.tooltip) {
                        this.imageEl.set({qtip:this.tooltip});
                }

                // update value of hidden field
                this.updateHidden();

        } // eo function onRender

        /**
         * Calls parent and updates hiddenField
         * @private
         */
        ,setValue:function(v) {
                v = this.convertValue(v);
                this.updateHidden(v);
                Ext.ux.form.XCheckbox.superclass.setValue.apply(this, arguments);
        } // eo function setValue

        /**
         * Updates hiddenField
         * @private
         */
        ,updateHidden:function(v) {
                v = undefined !== v ? v : this.checked;
        v = this.convertValue(v);
                if(this.hiddenField) {
                        this.hiddenField.dom.value = v ? this.submitOnValue : this.submitOffValue;
                        this.hiddenField.dom.name = v ? '' : this.el.dom.name;
                }
        } // eo function updateHidden

        /**
         * Converts value to boolean
         * @private
         */
        ,convertValue:function(v) {
                return (v === true || v === 'true' || v == 1 || v === this.submitOnValue || String(v).toLowerCase() === 'on');
        } // eo function convertValue

}); // eo extend

// register xtype
Ext.reg('xcheckbox', Ext.ux.form.XCheckbox);

// eof

