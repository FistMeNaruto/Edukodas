<?php

namespace Edukodas\Bundle\UserBundle\Repository;

use Edukodas\Bundle\UserBundle\Entity\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return User[]
     */
    public function findAllStudents()
    {
        return $this
            ->createQueryBuilder('u')
            ->where('u.roles LIKE :studentRole')
            ->setParameter('studentRole', '%' . User::STUDENT_ROLE . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $searchString
     * @return User[]
     */
    public function findStudentByString(string $searchString)
    {
        return $this
            ->createQueryBuilder('u')
            ->where('u.roles LIKE :studentRole')
            ->andWhere('u.fullName LIKE :searchString')
            ->setParameters([
                'studentRole' => '%' . User::STUDENT_ROLE . '%',
                'searchString' =>'%' . $searchString . '%'
            ])
            ->orderBy('u.fullName', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $searchString
     * @return User[]
     */
    public function findTeacherByString(string $searchString)
    {
        return $this
            ->createQueryBuilder('u')
            ->where('u.roles LIKE :teacherRole')
            ->andWhere('u.fullName LIKE :searchString')
            ->setParameters([
                'teacherRole' => '%' . User::TEACHER_ROLE . '%',
                'searchString' =>'%' . $searchString . '%'
            ])
            ->orderBy('u.fullName', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}
