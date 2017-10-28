{extends file="backend/base/header.tpl"}

{block name="backend/base/header/javascript" append}
<script type="text/javascript">
    /**
     * Modifies the global Ext.ClassManager to prevent Viison classes/overrides from being defined or loaded more than
     * once. Otherwise this could happen, if files are loaded by the ViisonCommonJSLoader and more than one sub app
     * depends on the same module, resulting in that dependency's code being included more than once in the response.
     * The class manager is modified in three different ways:
     *
     *      1. By adding a new default postprocessor that blocks the class loading, if the class is part of the
     *         protected namespace and already loaded.
     *      2. By overriding the 'createOverride()' method to block the override loading, if the override is part of the
     *         protected namespace and already loaded.
     *      3. By overriding the 'singleton' postprocessor to prevent it from instantiating the class, if the class is
     *         part of the protected namespace and already loaded. This is important, because the default 'singleton'
     *         postprocessor always creates a new instance of the loaded class without checking whether an instance
     *         already exists (this looks like a bug in ExtJS).
     *
     * Remark: We restrict the modifications to class/override definitions in out own 'namespace'. That is, we check
     *         whether the name of the loading class has the prefix 'Shopware.apps.Viison', which should be used by all
     *         our classes.
     */
    Ext.onReady(function () {
        (function (Manager) {
            // Prevent classes from being defined more than once
            Manager.defaultPostprocessors.push(function(className) {
                return !(className.indexOf('Shopware.apps.Viison') === 0 && Ext.ClassManager.isCreated(className));
            });

            // Prevent overrides from being applied more than once
            var originalCreateOverride = Manager.createOverride;
            Manager.createOverride = function (className) {
                if (className.indexOf('Shopware.apps.Viison') === 0 && Ext.ClassManager.isCreated(className)) {
                    return this;
                }

                return originalCreateOverride.apply(this, arguments);
            };

            // Prevent singletons from being instantiated more than once
            var originalSingletonPostProcessor = Manager.postprocessors.singleton.fn;
            Manager.postprocessors.singleton.fn = function (className) {
                if (className.indexOf('Shopware.apps.Viison') === 0 && Ext.ClassManager.isCreated(className)) {
                    return false;
                }

                return originalSingletonPostProcessor.apply(this, arguments);
            };
        })(Ext.ClassManager);
    });
</script>
{/block}

{block name="backend/base/header/css" append}
    <style media="screen">

        .viison-common--info-panel {
            padding: 10px 30px 10px 35px;
            line-height: 1.5 !important;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAKcSURBVDjLpZPLa9RXHMU/d0ysZEwmMQqZiTaP0agoaKGJUiwIxU0hUjtUQaIuXHSVbRVc+R8ICj5WvrCldJquhVqalIbOohuZxjDVxDSP0RgzyST9zdzvvffrQkh8tBs9yy9fPhw45xhV5X1U8+Yhc3U0LcEdVxdOVq20OA0ooQjhpnfhzuDZTx6++m9edfDFlZGMtXKxI6HJnrZGGtauAWAhcgwVnnB/enkGo/25859l3wIcvpzP2EhuHNpWF9/dWs/UnKW4EOGDkqhbQyqxjsKzMgM/P1ymhlO5C4ezK4DeS/c7RdzQoa3x1PaWenJjJZwT9rQ1gSp/js1jYoZdyfX8M1/mp7uFaTR8mrt29FEMQILr62jQ1I5kA8OF59jIItVA78dJertTiBNs1ZKfLNG+MUHX1oaURtIHEAOw3p/Y197MWHEJEUGCxwfHj8MTZIcnsGKxzrIURYzPLnJgbxvG2hMrKdjItjbV11CYKeG8R7ygIdB3sBMFhkem0RAAQ3Fuka7UZtRHrasOqhYNilOwrkrwnhCU/ON5/q04vHV48ThxOCuoAbxnBQB+am65QnO8FqMxNCjBe14mpHhxBBGCWBLxD3iyWMaYMLUKsO7WYH6Stk1xCAGccmR/Ozs/bKJuXS39R/YgIjgROloSDA39Deit1SZWotsjD8pfp5ONqZ6uTfyWn+T7X0f59t5fqDhUA4ry0fYtjJcWeZQvTBu4/VqRuk9/l9Fy5cbnX+6Od26s58HjWWaflwkusKGxjm1bmhkvLXHvh1+WMbWncgPfZN+qcvex6xnUXkzvSiYP7EvTvH4toDxdqDD4+ygT+cKMMbH+3MCZ7H9uAaDnqytpVX8cDScJlRY0YIwpAjcNcuePgXP/P6Z30QuoP4J7WbYhuQAAAABJRU5ErkJggg==);
            background-position: 10px 11px;
            background-repeat: no-repeat;
            background-color: #fcf8e3;
            color: #555555;
        }

        .viison-common--info-panel.has--shadow {
            margin-bottom: 2px;
            border-bottom: 1px solid #BBBBBB !important;
            box-shadow: 0 3px 3px 2px rgba(0,0,0,0.1);
        }

        .viison-common--info-panel strong {
            font-weight: bold !important;
        }

        .viison-common--info-panel a {
            color: #0000EE;
        }

        .viison-common--analytics-table .x-grid-row-summary {
            background-color: white;
        }

        .viison-common--analytics-table .x-grid-row-summary .x-grid-cell {
            padding-top: 6px;
            padding-bottom: 3px;
            border-top: 1px solid #555555;
            border-bottom: 1px solid #C9D6DC;
            font-weight: bold;
        }

        /* Pagination Toolbar */
        .viison_common_pagination_toolbar-toolbar .x-form-item-label {
            margin-top: 2px;
        }

        .viison_common_pagination_toolbar-toolbar .x-toolbar-text {
            margin-top: 0px !important;
        }

        /* Grid */
        .viison-common--grid.has-feature--hide-disabled-editors .x-field.x-item-disabled {
            opacity: 0;
        }

        .viison-common--grid.has--vertical-lines .x-grid-row .x-grid-cell + .x-grid-cell {
            border-left: 1px solid #E7EBEE !important;
        }

        .viison-common--grid .x-grid-empty {
            padding: 30px 40px;
            font-size: 110%;
            line-height: 1.5;
            text-align: center;
            color: #475c6a;
            opacity: 0.3;
        }

        /* Grid - Cell */
        .viison-common--grid .x-grid-cell-inner {
            padding-top: 4px !important;
            padding-bottom: 3px !important;
        }

        /* Grid - Row - Type "Warning" */
        .viison-common--grid .x-grid-row.is--warning .x-grid-cell {
            background-color: rgba(255,0,0,0.075);
        }

        .viison-common--grid .x-grid-row.is--warning .x-grid-cell-inner {
            color: red;
        }

        /* Grid - Cell - Icon */
        .viison-common--grid .x-grid-cell.has--icon .x-grid-cell-inner {
            padding-left: 30px;
            background-position: center left 8px;
            background-size: 16px;
            background-repeat: no-repeat;
        }

        /* Grid - Cell - Icon - Type "Warning" */
        .viison-common--grid .x-grid-cell.has--icon.is--warning .x-grid-cell-inner {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzAiIHZpZXdCb3g9IjAgMCAzMiAzMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48dGl0bGU+R3JvdXA8L3RpdGxlPjxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PHBhdGggZD0iTTMxLjAyMiAyNC43NkwxOC4yNiAyLjQ0Yy0uNDY3LS44MTYtMS4zMy0xLjMyLTIuMjY0LTEuMzItLjkzNCAwLTEuNzk2LjUwNC0yLjI2MyAxLjMyTC44OCAyNC45MmMtLjQ2Ny44MTYtLjQ2NyAxLjgyIDAgMi42MzguNDY2LjgxNiAxLjMzIDEuMzIgMi4yNjMgMS4zMmgyNS43MTVjMS40NDMgMCAyLjYxMy0xLjE4MiAyLjYxMy0yLjY0IDAtLjU0Ny0uMTY1LTEuMDU4LS40NDgtMS40OHpNMTQuNjQ2IDkuMjE1aDIuNzA3Yy4yMDYgMCAuMzc0LjE3LjM3NC4zNzdMMTYuOTggMTkuOTZjMCAuMjA3LS4xNjcuMzc2LS4zNzMuMzc2aC0xLjIxM2MtLjIwNyAwLS4zNzQtLjE3LS4zNzQtLjM3N2wtLjc0Ni0xMC4zNjdjMC0uMjA4LjE2Ni0uMzc3LjM3Mi0uMzc3ek0xNiAyNS4zMDZjLTEuMDA1IDAtMS44Mi0uODIyLTEuODItMS44MzcgMC0xLjAxNi44MTUtMS44MzggMS44Mi0xLjgzOCAxLjAwNSAwIDEuODIuODIyIDEuODIgMS44MzcgMCAxLjAxNC0uODE1IDEuODM3LTEuODIgMS44Mzd6IiBmaWxsPSIjRjhFNzFDIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNMzEuOTcgMjYuMjM4YzAgMS43MzMtMS4zOSAzLjE0LTMuMTEyIDMuMTRIMy4xNDNjLTEuMTE0IDAtMi4xNDItLjYtMi42OTgtMS41NzItLjU1NC0uOTctLjU1NC0yLjE2NSAwLTMuMTM1TDEzLjMgMi4xOTVjLjU1NS0uOTcyIDEuNTgzLTEuNTcgMi42OTYtMS41NyAxLjExNCAwIDIuMTQyLjU5OCAyLjY5NyAxLjU3bDEyLjc1NCAyMi4zYy4zNC41MTMuNTI0IDEuMTE2LjUyNCAxLjc0NHptLTEuMzYzLTEuMkwxNy44MjUgMi42OWMtLjM3OC0uNjYtMS4wNzUtMS4wNjctMS44My0xLjA2Ny0uNzUzIDAtMS40NS40MDYtMS44MjggMS4wNjdMMS4zMTQgMjUuMTY4Yy0uMzguNjYyLS4zOCAxLjQ4IDAgMi4xNDIuMzc3LjY2IDEuMDc1IDEuMDY3IDEuODMgMS4wNjdoMjUuNzE0YzEuMTY2IDAgMi4xMTMtLjk1NiAyLjExMy0yLjE0IDAtLjQzMy0uMTI3LS44NS0uMzYzLTEuMnoiIGZpbGw9IiM0QTRBNEEiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik0xNC42NDYgOS4yMTZoMi43MDdjLjIwNiAwIC4zNzQuMTcuMzc0LjM3N0wxNi45OCAxOS45NmMwIC4yMDctLjE2Ny4zNzYtLjM3My4zNzZoLTEuMjEzYy0uMjA3IDAtLjM3NC0uMTctLjM3NC0uMzc3bC0uNzQ2LTEwLjM2N2MwLS4yMDguMTY2LS4zNzcuMzcyLS4zNzd6TTE2IDI1LjMwN2MtMS4wMDUgMC0xLjgyLS44MjMtMS44Mi0xLjgzOCAwLTEuMDE2LjgxNS0xLjgzOCAxLjgyLTEuODM4IDEuMDA1IDAgMS44Mi44MjIgMS44MiAxLjgzNyAwIDEuMDE0LS44MTUgMS44MzctMS44MiAxLjgzN3oiIGZpbGw9IiM0QTRBNEEiLz48L2c+PC9zdmc+);
        }

        /* Grid - Cell - Icon - Type "Trend up" */
        .viison-common--grid .x-grid-cell.has--icon.is--trend-up .x-grid-cell-inner {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAzMiAyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48dGl0bGU+U2hhcGU8L3RpdGxlPjxwYXRoIGQ9Ik0zMS42MiAyMGMuMTUzIDAgLjI5LS4xMS4zNS0uMjg4LjA2Mi0uMTc2LjAyNC0uMzctLjA4My0uNUwxNi4yNjIuMTRjLS4wNzYtLjA5NC0uMTc1LS4xNC0uMjY2LS4xNC0uMDkgMC0uMTk3LjA0Ni0uMjY2LjE0TC4xMTMgMTkuMmMtLjEwNy4xMi0uMTQ1LjMyNS0uMDg0LjUxLjA2LjE3Ny4xOTcuMjg4LjM1LjI4OGgzMS4yNHoiIGZpbGwtcnVsZT0ibm9uemVybyIgZmlsbD0iIzRDRDk2NCIvPjwvc3ZnPg==);
            background-size: 10px;
        }

        /* Grid - Cell - Icon - Type "Trend down" */
        .viison-common--grid .x-grid-cell.has--icon.is--trend-down .x-grid-cell-inner {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAzMiAyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48dGl0bGU+U2hhcGU8L3RpdGxlPjxwYXRoIGQ9Ik0zMS42MiAwYy4xNTMgMCAuMjkuMTEuMzUuMjg4LjA2Mi4xNzYuMDI0LjM3LS4wODMuNUwxNi4yNjIgMTkuODZjLS4wNzYuMDk0LS4xNzUuMTQtLjI2Ni4xNC0uMDkgMC0uMTk3LS4wNDYtLjI2Ni0uMTRMLjExMy44Qy4wMDYuNjc4LS4wMzIuNDczLjAzLjI4OC4wOS4xMS4yMjYgMCAuMzggMGgzMS4yNHoiIGZpbGwtcnVsZT0ibm9uemVybyIgZmlsbD0iI0ZGM0IzMCIvPjwvc3ZnPg==);
            background-size: 10px;
        }

        /* Datefield */
        .viison-common--datefield.is--disabled .x-form-item-body {
            opacity: 0.75;
        }

        .viison-common--datefield.is--disabled .x-form-date-trigger {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
        }

        /* Checkbox with box label */
        .viison-common--checkbox-with-boxlabel label {
            margin-left: 8px;
            font-weight:bold;
            white-space:nowrap;
            vertical-align: 1px;
        }

        /* Charts title */
        .viison-common--chart--title {
            font-size: 14px;
            font-weight: bold;
            color: #475c6a;
        }

        /* Charts Tooltip */
        .viison-common--chart--tooltip {
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #a4b5c0;
            font-size: 11px;
            line-height: 1.5;
            background-color: white !important;
            color: #475c6a;
        }

        .viison-common--chart--tooltip div {
            font-weight: normal;
            white-space: nowrap;
        }

        .viison-common--chart--tooltip .is--header {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .viison-common--chart--tooltip .is--label {
            display: inline-block;
            margin-right: 5px;
            opacity: 0.7;
        }

        .viison-common--chart--tooltip .is--value {
            display: inline-block;
            font-weight: bold;
        }

    </style>
{/block}
