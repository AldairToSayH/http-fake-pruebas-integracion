import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
  vus: 5,
  duration: '10s',
};

export default function () {
  const res = http.get('http://127.0.0.1:8000/api/ping');

  check(res, {
    'status es 200': (r) => r.status === 200,
    'respuesta contiene ok': (r) => r.body.includes('ok'),
  });

  sleep(1);
}
