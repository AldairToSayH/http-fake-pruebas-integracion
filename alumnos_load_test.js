import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
  stages: [
    { duration: '10s', target: 10 },
    { duration: '20s', target: 30 },
    { duration: '10s', target: 0 },
  ],
  thresholds: {
    http_req_duration: ['p(95)<500'],
    checks: ['rate>0.95'],
  },
};

export default function () {
  const res = http.get('http://127.0.0.1:8000/api/alumnos');

  check(res, {
    'status es 200': (r) => r.status === 200,
  });

  sleep(1);
}
