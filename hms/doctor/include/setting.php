<div class="settings panel panel-default hidden-xs hidden-sm" id="settings">
    <button ct-toggle="toggle" data-toggle-class="active" data-toggle-target="#settings" class="btn btn-default">
        <i class="fa fa-spin fa-gear"></i>
    </button>
    <div class="panel-heading">
        Sélecteur de style
    </div>
    <div class="panel-body">
        <div class="setting-box clearfix">
            <span class="setting-title pull-left">En-tête fixe</span>
            <span class="setting-switch pull-right">
                <input type="checkbox" class="js-switch" id="fixed-header" />
            </span>
        </div>
        
        <div class="setting-box clearfix">
            <span class="setting-title pull-left">Barre latérale fixe</span>
            <span class="setting-switch pull-right">
                <input type="checkbox" class="js-switch" id="fixed-sidebar" />
            </span>
        </div>
        
        <div class="setting-box clearfix">
            <span class="setting-title pull-left">Barre latérale fermée</span>
            <span class="setting-switch pull-right">
                <input type="checkbox" class="js-switch" id="closed-sidebar" />
            </span>
        </div>
        
        <div class="setting-box clearfix">
            <span class="setting-title pull-left">Pied de page fixe</span>
            <span class="setting-switch pull-right">
                <input type="checkbox" class="js-switch" id="fixed-footer" />
            </span>
        </div>
        
        <div class="colors-row setting-box">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="color-theme theme-<?php echo $i; ?>">
                    <div class="color-layout">
                        <label>
                            <input type="radio" name="setting-theme" value="theme-<?php echo $i; ?>">
                            <span class="ti-check"></span>
                            <span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"></span> </span>
                            <span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span>
                        </label>
                    </div>
                </div>
                <?php if ($i % 2 == 0 && $i < 6): ?>
                    </div><div class="colors-row setting-box">
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>