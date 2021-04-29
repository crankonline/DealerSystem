app.service('RequisitesRegisterErrors', function () {
    return {
        get: get,
        Errors: {
            Juristic: {
                name: {
                    maxlength: "Сокращенное наименование не должно превышать 64 символа, текущая днина - "
                },
                bik: {
                    require: "Поле БИК должно быть обязательно заполнено.",
                    notFound: "БИК не найден в базе данных."
                },
                gked: {
                    require: "Поле ГКЭД должно быть обязательно заполнено.",
                    notFound: "ГКЭД не найден в базе данных."
                }
            },
            Representatives: {},
            Files: {
                require: "Файл обзятельный к загрузке.",
                maxSize: "Файл слишком большой, максимальный разрешенный размер 5MB. Вы загружаете - "
            }
        }
    }

    function get() {
        return this.Errors
    }
});