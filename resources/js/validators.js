/**
 * Validating phone number in Brazilian format.
 */
export function phoneBR(value = '') {
    let regex = new RegExp(/(\(\d{2}\))?(\d{4,5}\-\d{4})/g)
    return regex.test(value)
}

export function maxUpload(file = '', vm) {
    if (file==='') {
        return false
    }
    let maxSize = vm.config.attachment.maxsize * 1000
    return (file.size < maxSize)
}
