/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   Shopware
 * @package    Article
 * @subpackage Category
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Controller - Article backend module
 */
//{namespace name=backend/article/view/main}
//{block name="backend/article/controller/media"}
Ext.define('Shopware.apps.Article.controller.Media', {
    /**
     * The parent class that this class extends.
     * @string
     */
    extend:'Ext.app.Controller',

    /**
     * Contains all snippets for the component.
     * @object
     */
    snippets: {
        upload: {
            text: '{s name=media/upload/text}The image was uploaded successfully.{/s}'
        },
        success: {
            title: '{s name=media/success/title}Success{/s}',
            mapping: '{s name=media/success/mapping}The image mapping saved successfully{/s}'
        },
        failure: {
            title: '{s name=media/failure/title}Failure{/s}',
            mapping: '{s name=media/failure/mapping_violation}An error occurred while saving the image mapping:{/s}',
            noIdViolation: '{s name=media/failure/no_id_violation}No id passed to the php controller action{/s}',
            noMoreInformation: '{s name=media/failure/no_more_information}No more information available.{/s}',
            onlyOneCanBeChecked: '{s name=media/failure/only_one_node}You can only activate one configurator option per configurator group.{/s}'
        },
        growlMessage: '{s name=growlMessage}Article{/s}'
    },
    /**
     * Set component references for easy access
     * @array
     */
    refs:[
        { ref:'mediaList', selector:'article-detail-window article-image-list dataview[name=image-listing]' },
        { ref:'mediaListComponent', selector:'article-detail-window article-image-list' },
        { ref:'previewButton', selector:'article-detail-window article-image-list button[action=previewImage]' },
        { ref:'removeButton', selector:'article-detail-window article-image-list button[action=removeImage]' },
        { ref:'mediaInfo', selector:'article-detail-window article-image-info' },
        { ref:'mediaDropZone', selector:'article-detail-window article-image-upload article-image-drop-zone' }
    ],

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @params orderId - The main controller can handle a orderId parameter to open the order detail page directly
     * @return void
     */
    init:function () {
        var me = this;

        me.control({
            'article-detail-window article-image-list': {
                mediaSelect: me.onSelectMedia,
                mediaDeselect: me.onDeselectMedia,
                mediaMoved: me.onMediaMoved,
                markPreviewImage: me.onMarkPreviewImage,
                removeImage: me.onRemoveImage,
                openImageMapping: me.onOpenImageMapping,
                download: me.onDownload
            },
            'article-image-mapping-window': {
                displayNewRuleWindow: me.onDisplayNewRuleWindow,
                saveMapping: me.onSaveMapping,
                cancel: me.onMappingCancel
            },
            'article-image-rule-window': {
                nodeCheck: me.onNodeCheck,
                createImageMapping: me.onCreateImageMapping
            },
            'article-image-drop-zone html5fileupload': {
                fileUploaded: me.onFileUploaded
            },
            'article-detail-window article-image-info': {
                saveImageSettings: me.onSaveImageSettings
            },
            'article-detail-window article-image-upload': {
                mediaUpload: me.onMediaUpload
            }
        });
        me.callParent(arguments);
    },

    /**
     * Event listener function of the settings panel in the image tab.
     * Fired when the user clicks the button "save settings"
     * @param form
     * @param record
     * @return Boolean
     */
    onSaveImageSettings: function(form, record, callback) {
        var me = this;
        var info = me.getMediaInfo();
        var list = me.getMediaList();

        if (!form || !record) {
            callback();
            return false;
        }
        form.getForm().updateRecord(record);

        info.attributeForm.saveAttribute(record.get('id'), function() {
            callback();
        });

        return true;
    },

    /**
     * Event listener function of the mapping window. Fired when the user
     * clicks the cancel button. All changes will be reverted.
     */
    onMappingCancel: function(mappingWindow) {
        mappingWindow.destroy();
    },

    /**
     * Event listener function of the mapping window. Fired when the user
     * clicks the save button. First on this point the image configuration will
     * be saved to the database and the different article variant images will be created.
     *
     * @param mappingWindow
     */
    onSaveMapping: function(mappingWindow) {
        var me = this;

        //first we have to get the image record of the mapping window.
        var record = mappingWindow.record;

        //than we create a new media mapping store which used to fire the ajax request in all cases to the same backend controller function
        var mappingStore = Ext.create('Shopware.apps.Article.store.MediaMapping');

        //now we set the mapping store of the window into the associated image store.
        record.getMappingsStore =  mappingWindow.store;

        //to be sure the request will be fired, we set the dirty flag of the record
        record.setDirty();

        //now we add the image record to the new store
        mappingStore.add(record);

        //now we set the hasConfig flag for the image manually
        record.set('hasConfig', (record.getMappingsStore.getCount() > 0));

        mappingWindow.setLoading(true);
        //at least we call the sync function to send the request "saveMediaMapping"
        mappingStore.sync({
            success: function(result, operation) {
                mappingWindow.setLoading(false);
                mappingWindow.destroy();
                Shopware.Notification.createGrowlMessage(me.snippets.success.title, me.snippets.success.mapping, me.snippets.growlMessage);
            },
            failure: function(result, operation) {
                var rawData = record.getProxy().getReader().rawData,
                    message = rawData.message;

                mappingWindow.setLoading(false);
                if (Ext.isString(message) && message.length > 0) {
                    message = me.snippets.failure.mapping + '<br>' +  message;
                } else {
                    message = me.snippets.failure.mapping + '<br>' + me.snippets.failure.noMoreInformation;
                }
                Shopware.Notification.createGrowlMessage(me.snippets.failure.title, message, me.snippets.growlMessage);
            }
        });
    },

    /**
     * Event listener function of the "newRule" window. Fired when the user selects
     * some options in the tree panel and clicks the save button to save the new mapping rule.
     * The function iterates first all defined configurator groups to get all options
     * to resolve the option ids of the tree nodes with models.
     * After all options get of the global store, the function creates a new mediaMapping
     * model which each selected option as rule.
     * At least the new mapping model will be added to the mappingWindow grid store.
     *
     * @param ruleWindow
     */
    onCreateImageMapping: function(ruleWindow) {
        var me = this,
            record = ruleWindow.record,
            tree = ruleWindow.configuratorTree,
            nodes = tree.getChecked();

        if (nodes.length === 0) {
            return false;
        }

        //create new store to collect all defined configurator options.
        var allOptions = Ext.create('Ext.data.Store', { model: 'Shopware.apps.Article.model.ConfiguratorOption' });
        me.subApplication.configuratorGroupStore.each(function(group) {
            if (group instanceof Ext.data.Model &&
                    group.getConfiguratorOptions() instanceof Ext.data.Store &&
                    group.getConfiguratorOptions().getCount() > 0) {

                if (group.getConfiguratorOptions()) {
                    allOptions.add(group.getConfiguratorOptions().data.items);
                }
            }
        });

        //create a new mapping model which contains the different configurator options as single rule
        var mapping = Ext.create('Shopware.apps.Article.model.MediaMapping', {
            id: null,
            imageId: record.get('id')
        });

        //now we create a store for the selected options to collect all rules.
        var ruleStore = Ext.create('Ext.data.Store', { model: 'Shopware.apps.Article.model.MediaMappingRule' });

        //we have to iterate the nodes to resolve the configured option ids with models.
        Ext.each(nodes, function(node) {
            var option = allOptions.getById(node.get('id'));

            //the rule model has an association to an configurator option. So we have to create for extJs a new Ext.data.Store
            //to use them as association store.
            var optionStore = Ext.create('Ext.data.Store', { model: 'Shopware.apps.Article.model.ConfiguratorOption' });
            optionStore.add(option);

            //now we create a new rule with the configured option id.
            //we don't have to set the mapping id, because extJs resolve it over the association
            var rule = Ext.create('Shopware.apps.Article.model.MediaMappingRule', {
                id: null,
                optionId: node.get('id')
            });

            //at least we set the associated option store in the new mapping rule model.
            rule.getOptionStore = optionStore;
            ruleStore.add(rule);
        });
        mapping.getRulesStore = ruleStore;
        ruleWindow.store.add(mapping);
        ruleWindow.destroy();
    },

    /**
     * Event listener function of the newRule window. Fired when the user select/deselect a tree node.
     * The user can only select one node per configurator group. So we have to check
     * if the checked node is the only node in the configurator group which is checked.
     *
     * @param node
     * @param checked
     * @return Boolean
     */
    onNodeCheck: function(node, checked) {
        var me = this, onlyOneChecked = true,
            groupNode = null;

        //first we check if the checked parameter is true and the node has a parent node.
        if (checked && node && node.parentNode) {
            //if this is the case the parent node is the configurator group node.
            groupNode = node.parentNode;
            //we have to iterate the child nodes of the group node.
            Ext.each(groupNode.childNodes, function(childNode) {
                //if the queue node not equals the checked node we have to check the "checked" property
                if (childNode !== node && childNode.get('checked')) {
                    //if the checked property is set to true, an other node was already checked in the group
                    onlyOneChecked = false;
                    return false;
                }
            });
            //if the checked node isn't the only checked we have to remove the checked property.
            if (!onlyOneChecked) {
                node.set('checked', false);
                Shopware.Notification.createGrowlMessage(me.snippets.failure.title, me.snippets.failure.onlyOneCanBeChecked, me.snippets.growlMessage);
            }
        }
        return onlyOneChecked;
    },

    /**
     * Event listener function of the mapping window. Fired when the user want to define a new image mapping.
     * Opens the newRule window which contains a tree panel with all activated configurator groups and options.
     * @param window
     */
    onDisplayNewRuleWindow: function(window) {
        var me = this;

        var ruleWindow = me.getView('image.NewRule').create({
            store: window.store,
            record: window.record,
            configuratorGroupStore: me.subApplication.configuratorGroupStore
        }).show();
    },

    /**
     * Event listener function of the image listing. Fired when the user clicks the "config" button in the image listing
     * to configure image mappings.
     *
     * @return Boolean
     */
    onOpenImageMapping: function() {
        var me = this, selected = null,
            mediaList = me.getMediaList();

        if (mediaList.getSelectionModel() &&  mediaList.getSelectionModel().selected && mediaList.getSelectionModel().selected.first()) {
            selected = mediaList.getSelectionModel().selected.first();
        }

        if (!selected instanceof Ext.data.Model) {
            return false;
        }
        var mappingWindow = me.getView('image.Mapping').create({
            record: selected
        }).show();
    },

    /**
     * Event listener function of the image listing. Fired when the user selects an image which isn't defined as
     * preview image. The user want now to define the selected image as new preview image.
     * @return Boolean
     */
    onMarkPreviewImage: function() {
        var me = this,
            mediaList = me.getMediaList(),
            store = mediaList.getStore(),
            selected = null;

        if (mediaList.getSelectionModel() &&  mediaList.getSelectionModel().selected && mediaList.getSelectionModel().selected.first()) {
            selected = mediaList.getSelectionModel().selected.first();
        }

        if (!(selected instanceof Ext.data.Model)) {
            return false;
        }

        store.each(function(item) {
            item.set('main', 2);
        });
        selected.set('main', 1);
    },

    /**
     * Removes the selected image.
     *
     * @return boolean
     */
    onRemoveImage: function () {
        var me = this,
            mediaList = me.getMediaList(),
            store = mediaList.getStore();

        store.remove(mediaList.getSelectionModel().getSelection());

        var main = store.findExact('main', 1);
        var first = store.getAt(0);
        if (main < 0 && first instanceof Ext.data.Model) {
            first.set('main', 1);
        }
    },

    /**
     * Event will be fired when the user want to upload images over the button on the image tab.
     *
     * @event
     * @param [object]
     */
    onMediaUpload: function(field) {
        var dropZone = this.getMediaDropZone(), me = this;

        if(Ext.isIE || Ext.isSafari) {
            var form = field.ownerCt;
            form.submit({
                success: function() {
                    Shopware.Notification.createGrowlMessage(me.snippets.growlMessage, me.snippets.upload.text);
                }
            });
        } else {
            this.uploadMedia(field, dropZone);
        }
    },

    /**
     * Internal helper function to upload article images.
     * @param field
     * @param dropZone
     */
    uploadMedia: function(field, dropZone) {
        var fileField = field.getEl().down('input[type=file]').dom;
        dropZone.mediaDropZone.iterateFiles(fileField.files);
    },

    /**
     * Event listener function which fired when the user want to download the original image.
     *
     * @param file
     */
    onDownload: function(file) {
        var me = this;

        if (!(file instanceof Ext.data.Model)) {
            return;
        }
        window.open(file.get('original'),file.get('name'),'width=1024,height=768');
    },

    /**
     * Event listener function which fired when the user select an article image
     * over the media selection or uploads images over the drag and drop zone or over
     * the file upload field.
     *
     * @param media
     */
    onFileUploaded: function(response) {
        var me = this,
            mediaList = me.getMediaList(),
            store = mediaList.getStore();

        var operation = Ext.decode(response.responseText);
        if (operation.success === true) {
            var media = Ext.create('Shopware.apps.Article.model.Media', operation.data);
            media.set('path', operation.data.name);
            media.set('original', operation.data.path);
            media.set('thumbnail', operation.data.path);
            media.set('main', 2);
            media.set('mediaId', operation.data.id);

            if (store.getCount() === 0) {
                media.set('main', 1);
            }
            media.set('id', 0);
            store.add(media);
        }
    },

    /**
     * Event will be fired when the user select an article image in the listing.
     *
     * @param [Ext.selection.DataViewModel] The selection data view model of the Ext.view.View
     * @param [Shopware.apps.Article.model.Media] The selected media
     */
    onSelectMedia: function(dataViewModel, media, previewButton, removeButton, configButton, downloadButton) {
        var me = this,
            infoView = me.getMediaInfo();

        if (!infoView.record) {
            me.loadInfoView(dataViewModel, media, previewButton, removeButton, configButton, downloadButton);
            return;
        }
        var list = me.getMediaList();

        list.setDisabled(true);
        try {
            me.onSaveImageSettings(infoView.settingsForm, infoView.record, function () {
                me.loadInfoView(dataViewModel, media, previewButton, removeButton, configButton, downloadButton, function () {
                    list.setDisabled(false);
                });
            });
        } catch (e) {
            list.setDisabled(false);
        }
    },

    loadInfoView: function(dataViewModel, media, previewButton, removeButton, configButton, downloadButton, callback) {
        var me = this;
        var infoView = me.getMediaInfo();

        callback = callback ? callback : Ext.emptyFn;

        if (media instanceof Ext.data.Model) {
            infoView.thumbnail.update(media.data);
            infoView.record = media;
            infoView.loadRecord(media);
            infoView.settingsForm.loadRecord(media);
            infoView.attributeForm.loadAttribute(media.get('id'), function() {
                callback();
            });
        }
        me.disableImageButtons(dataViewModel, previewButton, removeButton, configButton, downloadButton);
    },

    /**
     * Event will be fired when the user de select an article image in the listing.
     *
     * @param [Ext.selection.DataViewModel] The selection data view model of the Ext.view.View
     * @param [Shopware.apps.Article.model.Media] The selected media
     */
    onDeselectMedia: function(dataViewModel, media, previewButton, removeButton, configButton, downloadButton) {
        this.disableImageButtons(dataViewModel, previewButton, removeButton, configButton, downloadButton);
    },

    /**
     * Helper function to disable/enable the toolbar buttons of the image list.
     * @param dataViewModel
     * @param previewButton
     * @param removeButton
     * @param configButton
     * @param downloadButton
     */
    disableImageButtons: function(dataViewModel, previewButton, removeButton, configButton, downloadButton) {
        var me = this, selected = null,
            disabled = (dataViewModel.selected.length === 0);

        if (dataViewModel.selected && dataViewModel.selected.first()) {
            selected = dataViewModel.selected.first();
        }

        removeButton.setDisabled(disabled);
        previewButton.setDisabled(disabled);


        if (!selected || !selected.get('id') > 0 || me.subApplication.splitViewActive) {
            configButton.setDisabled(true);
            downloadButton.setDisabled(true);
        } else {
            configButton.setDisabled(disabled);
            downloadButton.setDisabled(disabled);
        }

        if (!disabled) {
            previewButton.setDisabled(selected.get('main')===1);
        }
    },

    /**
     * Event will be fired when the user move an image.
     *
     * @param [Ext.data.Store] The media store
     * @param [Shopware.apps.Article.model.Media] The dragged record
     * @param [Shopware.apps.Article.model.Media] The target record, on which the dragged record dropped
     */
    onMediaMoved: function(mediaStore, draggedRecord, targetRecord) {
        var me = this, index, indexOfDragged;

        if (!mediaStore instanceof Ext.data.Store
                || !draggedRecord instanceof Ext.data.Model
                || !targetRecord instanceof Ext.data.Model) {
            return false;
        }
        index = mediaStore.indexOf(targetRecord);
        indexOfDragged = mediaStore.indexOf(draggedRecord);
        if (index > indexOfDragged) {
            index--;
        }
        mediaStore.remove(draggedRecord);
        mediaStore.insert(index, draggedRecord);
        return true;
    }
});
//{/block}
