var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g = Object.create((typeof Iterator === "function" ? Iterator : Object).prototype);
    return g.next = verb(0), g["throw"] = verb(1), g["return"] = verb(2), typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (g && (g = 0, op[0] && (_ = 0)), _) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var HttpClient = /** @class */ (function () {
    function HttpClient(baseUrl) {
        if (baseUrl === void 0) { baseUrl = ''; }
        this.headers = {};
        this.baseUrl = baseUrl.trim().replace(/\/$/, ''); // Удаляем слэш в конце
    }
    /**
     * GET-запрос
     */
    HttpClient.prototype.get = function (url, params, onSuccess, onFailure) {
        this.request('GET', url, params, onSuccess, onFailure);
    };
    /**
     * POST-запрос
     */
    HttpClient.prototype.post = function (url, data, onSuccess, onFailure) {
        this.request('POST', url, data, onSuccess, onFailure);
    };
    /**
     * PUT-запрос
     */
    HttpClient.prototype.put = function (url, data, onSuccess, onFailure) {
        this.request('PUT', url, data, onSuccess, onFailure);
    };
    /**
     * DELETE-запрос
     */
    HttpClient.prototype.delete = function (url, params, onSuccess, onFailure) {
        this.request('DELETE', url, params, onSuccess, onFailure);
    };
    /**
     * Общий метод для выполнения HTTP-запросов
     */
    HttpClient.prototype.request = function (method, url, data, onSuccess, onFailure) {
        return __awaiter(this, void 0, void 0, function () {
            var fullUrl, config, searchParams_1, searchParams_2, response, result, error_1, status_1, message;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        _a.trys.push([0, 3, , 4]);
                        fullUrl = this.baseUrl + url;
                        config = {
                            method: method,
                            headers: {}
                        };
                        if (['POST', 'PUT'].includes(method)) {
                            if (data instanceof FormData) {
                                config.body = data;
                            }
                            else {
                                config.headers['Content-Type'] =
                                    'application/x-www-form-urlencoded';
                                searchParams_1 = new URLSearchParams();
                                Object.entries(data !== null && data !== void 0 ? data : {}).forEach(function (_a) {
                                    var key = _a[0], value = _a[1];
                                    searchParams_1.append(key, String(value));
                                });
                                config.body = searchParams_1.toString();
                            }
                        }
                        if ((method === 'GET' || method === 'DELETE') && data) {
                            searchParams_2 = new URLSearchParams();
                            Object.entries(data).forEach(function (_a) {
                                var key = _a[0], value = _a[1];
                                searchParams_2.append(key, String(value));
                            });
                            fullUrl += '?' + searchParams_2.toString();
                        }
                        return [4 /*yield*/, fetch(fullUrl, config)];
                    case 1:
                        response = _a.sent();
                        if (!response.ok) {
                            throw new Error("HTTP error! Status: ".concat(response.status));
                        }
                        return [4 /*yield*/, response.json()];
                    case 2:
                        result = _a.sent();
                        if (onSuccess) {
                            onSuccess(result);
                        }
                        return [3 /*break*/, 4];
                    case 3:
                        error_1 = _a.sent();
                        status_1 = error_1 instanceof Error && 'status' in error_1
                            ? error_1.status
                            : 0;
                        message = error_1 instanceof Error ? error_1.message : String(error_1);
                        if (onFailure) {
                            onFailure(status_1, message);
                        }
                        else {
                            console.error('HTTP Request Error:', status_1, message);
                        }
                        return [3 /*break*/, 4];
                    case 4: return [2 /*return*/];
                }
            });
        });
    };
    HttpClient.prototype.addHeader = function (key, value) {
        this.headers[key] = value;
    };
    HttpClient.prototype.clearHeaders = function () {
        this.headers = {};
    };
    return HttpClient;
}());
export { HttpClient };
