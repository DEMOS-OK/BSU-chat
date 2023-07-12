/**
 * Send async request to search users
 *
 * @param {string} nameQuery
 * @returns {Promise<void>}
 */
const searchUsersByNameQuery = async (nameQuery) => {
    return axios.get(
        route("search-users", {
            name_query: nameQuery,
        })
    );
};

export default searchUsersByNameQuery;
