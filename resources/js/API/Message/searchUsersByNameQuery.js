/**
 * Send async request to search users
 *
 * @param {string} nameQuery
 * @param {Number[]} except
 * @returns {Promise<void>}
 */
const searchUsersByNameQuery = async (nameQuery, except = []) => {
    return axios.post(
        route("search-users", {
            name_query: nameQuery,
            except: except,
        })
    );
};

export default searchUsersByNameQuery;
