class StringUtils
{
    static capitalizeFirstLetter(string) {
        if (StringUtils.isEmpty(string)) {
            return "";
        }
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    static isEmpty(str) {
        return (!str || str.length === 0 );
    }

    static random (length) {
      return Math.random().toString(36).substring(length + 1);
    }
}
export default StringUtils