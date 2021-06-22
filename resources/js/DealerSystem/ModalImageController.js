app.controller('ModalInstanceCtrl', function ($uibModalInstance, data) {
        let pc = this;
        pc.data = data;

        pc.ok = function () {
            pc.data = {};
            $uibModalInstance.close();
        };
    }
);